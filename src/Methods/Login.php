<?php

namespace BrandStudio\Auth\Methods;

use BrandStudio\Auth\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

class Login extends Base
{

    public static function execute(AuthService $authService, string $login, string $password)
    {
        $user = $authService->getUser($login);
        $authService->checkUserPassword($user, $password);
        $client = DB::table('oauth_clients')->find(2);

        request()->request->add([
            'client_id' => $client->id,
            'client_secret' => $client->secret,
            'grant_type' => 'password',
            'username' => $login,
            'password' => $password,
        ]);

        $token = Request::create(
            '/oauth/token',
            'POST'
        );

        return Route::dispatch($token);
    }


}
