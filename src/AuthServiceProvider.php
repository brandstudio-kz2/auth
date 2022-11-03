<?php
namespace BrandStudio\Auth;

use Illuminate\Support\ServiceProvider;
use BrandStudio\Auth\AuthService;
use BrandStudio\Auth\Http\Middleware\MbAuthenticate;
use Illuminate\Support\Facades\Validator;

class AuthServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->configure();
        $this->bindings();

        $this->registerMiddlewares();

        if ($this->app->runningInConsole()) {
            $this->publish();
        }
    }

    public function boot()
    {
        $this->loadValidations();

        if (config('brandstudio.auth.setup_routes')) {
            $this->loadRoutes();
        }

        $this->loadResources();

        if ($this->app->runningInConsole()) {
            $this->loadMigrations();
            $this->publish();
        }
    }

    private function configure()
    {
        $this->mergeConfigFrom(__DIR__.'/config/auth.php', 'brandstudio.auth');
    }

    private function registerMiddlewares()
    {
        $this->app['router']->aliasMiddleware('mbauth', MbAuthenticate::class);
    }

    private function bindings()
    {
        $this->app->bind('brandstudio_auth',function() {
            return new AuthService(config('brandstudio.auth'));
        });
    }

    private function publish()
    {
        $this->publishes([
            __DIR__.'/config/auth.php' => config_path('brandstudio/auth.php')
        ], 'config');

        $this->publishes([
            __DIR__.'/resources/lang' => resource_path('lang/vendor/brandstudio')
        ], 'translations');

        $this->publishes([
            __DIR__.'/resources/views' => resource_path('views/vendor/brandstudio')
        ], 'views');

        $this->publishes([
            __DIR__.'/database/migrations/' => database_path('migrations')
        ], 'migrations');

        $this->publishes([
            __DIR__.'/routes//' => base_path('routes')
        ], 'routes');
    }

    private function loadValidations()
    {
        Validator::extend('email_phone', function ($attribute, $value, $parameters, $validator) {
            if (in_array('phone', config('brandstudio.auth.auth_fields')) && preg_match('/7(\d){10}/', $value, $match)) {
                return true;
            }
            return in_array('email', config('brandstudio.auth.auth_fields')) && filter_var($value, FILTER_VALIDATE_EMAIL);
        });

        Validator::extend('phone', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/7(\d){10}/', $value, $match);
        });
    }

    private function loadRoutes()
    {
        $path = '/routes/auth.php';
        $path = file_exists(base_path().$path) ? base_path().$path : __DIR__.$path;
        $this->loadRoutesFrom($path);
    }

    private function loadMigrations()
    {
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }

    private function loadResources()
    {
        $this->loadViewsFrom(__DIR__.'/resources/views', 'brandstudio');
        $this->loadTranslationsFrom(__DIR__.'/resources/lang', 'brandstudio');
    }
}
