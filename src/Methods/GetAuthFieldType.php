<?php

namespace BrandStudio\Auth\Methods;

use BrandStudio\Auth\AuthService;

class GetAuthFieldType extends Base
{

    public static function execute(AuthService $authService, string $login) : string
    {
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
        if (!in_array($field, config('brandstudio.auth.auth_fields'))) {
            abort(400, trans('brandstudio::auth.invalid_data'));
        }
        return $field;
    }

}
