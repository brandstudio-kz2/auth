<?php

return [

    'redirect_url' => '',

    'setup_routes' => true,
    'route_prefix' => 'auth',
    'route_middlewares' => [],

    'model' => 'App\User',
    'auth_fields' => ['email', 'phone'],

    'password_requirements' => 'required|min:6',
    'login_requirements' => 'required|email_phone',

    'new_password_length' => 6,
    'verification_code_length' => 4,
    'verification_token_length' => 32,
    'verification_token_lifetime' => 24*60,// in minutes


    'sms_service' => 'BrandStudio\\Sms\\Facades\\Sms',
];
