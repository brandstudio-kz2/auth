<?php

namespace BrandStudio\Auth\Methods;

use BrandStudio\Auth\AuthService;
use Illuminate\Support\Facades\Hash;

class UpdatePassword extends Base
{

    public static function execute(AuthService $authService, $user, string $password, string $new_password)
    {
        $authService->checkUserPassword($user, $password);
        $user->update([
            'password' => Hash::make($new_password),
        ]);
    }

}
