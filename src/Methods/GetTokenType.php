<?php

namespace BrandStudio\Auth\Methods;

use BrandStudio\Auth\AuthService;
use BrandStudio\Auth\Models\VerificationToken;

class GetTokenType extends Base
{

    public static function execute(AuthService $authService, VerificationToken $token) : string
    {
        if ($authService->isPasswordResetToken($token)) {
            return 'password_reset';
        }
        return $authService->isRegistrationToken($token) ? 'registration' : 'confirm_email';
    }

}
