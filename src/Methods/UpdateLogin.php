<?php

namespace BrandStudio\Auth\Methods;

use BrandStudio\Auth\AuthService;

class UpdateLogin extends Base
{

    public static function execute(AuthService $authService, $user, string $login)
    {
        // $authService->checkUserPassword($user, $password);
        $authService->createVerificationToken($user->id, $login);
    }

}
