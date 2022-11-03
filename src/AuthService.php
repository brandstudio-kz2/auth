<?php

namespace BrandStudio\Auth;

class AuthService
{

    public $model;
    public $sms_service;
    public $auth_fields;
    public $verification_code_length;
    public $verification_token_length;
    public $verification_token_lifetime;
    public $new_password_length;

    public function __construct(array $config)
    {
        $this->model = $config['model'];
        $this->auth_fields = $config['auth_fields'];
        $this->sms_service = $config['sms_service'];
        $this->new_password_length = $config['new_password_length'];
        $this->verification_code_length = $config['verification_code_length'];
        $this->verification_token_length = $config['verification_token_length'];
        $this->verification_token_lifetime = $config['verification_token_lifetime'];
    }

    public function __call($method, $arguments)
    {
        $method = \Str::studly($method);
        $class = "BrandStudio\Auth\Methods\\{$method}";
        array_unshift($arguments, $this);

        if (class_exists($class)) {
            return call_user_func_array([$class, 'execute'], $arguments);
        } else {
            throw new \Exception("BrandStudio Auth exception: Called undefined {$method} method");
        }
    }

}
