<?php

namespace BrandStudio\Auth\Methods;

use BrandStudio\Auth\AuthService;

class GeneratePassword extends Base
{

    public static function execute(AuthService $authService) : string
    {
        return (string)rand(10 ** ($authService->new_password_length - 1), 10 ** $authService->new_password_length - 1);
    }

}
