<?php

namespace BrandStudio\Auth\Methods;

use BrandStudio\Auth\AuthService;
use BrandStudio\Auth\Models\VerificationToken;

class IsPasswordResetToken extends Base
{

    public static function execute(AuthService $authService, VerificationToken $token) : bool
    {
        return !is_null($token->password);
    }

}
