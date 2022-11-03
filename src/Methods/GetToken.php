<?php

namespace BrandStudio\Auth\Methods;

use BrandStudio\Auth\AuthService;
use BrandStudio\Auth\Models\VerificationToken;

class GetToken extends Base
{

    public static function execute(AuthService $authService, string $login, string $token) : VerificationToken
    {
        return VerificationToken::where('login', $login)->where('token', $token)->first() ?? abort(404, trans('brandstudio::auth.token_not_found'));
    }

}
