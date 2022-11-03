<?php

namespace BrandStudio\Auth\Methods;

use BrandStudio\Auth\AuthService;
use BrandStudio\Auth\Models\VerificationToken;

class IsRegistrationToken extends Base
{

    public static function execute(AuthService $authService, VerificationToken $token)
    {
        foreach(config('brandstudio.auth.auth_fields') as $field) {
            if ($token->user->$field) {
                return false;
            }
        }
        return true;
    }

}
