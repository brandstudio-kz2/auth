<?php

namespace BrandStudio\Auth\Methods;

use BrandStudio\Auth\AuthService;

class GetUser extends Base
{

    public static function execute(AuthService $authService, string $login)
    {
        return (new $authService->model)->findForPassport($login) ?? abort(404, trans('brandstudio::auth.user_not_found'));
    }

}
