<?php

namespace BrandStudio\Auth\Methods;

use BrandStudio\Auth\AuthService;
use Illuminate\Support\Facades\Hash;

class CheckUserPassword extends Base
{

    public static function execute(AuthService $authService, $user, string $password)
    {
        if (!Hash::check($password, $user->password)) {
            abort(401, trans('brandstudio::auth.invalid_password'));
        }
    }

}
