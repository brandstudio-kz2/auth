<?php

namespace BrandStudio\Auth\Methods;

use BrandStudio\Auth\AuthService;

class Verify extends Base
{

    public static function execute(AuthService $authService, string $login, string $token)
    {
        $token = $authService->getToken($login, $token);// Token is not string anymore :)

        // TODO: count number of tries and ban if maximum is reached

        if ($authService->isPasswordResetToken($token)) {
            $token->user->update([
                'password' => $token->password,
            ]);
        } else {
            $token->user->update([
                $authService->getAuthFieldType($login) => $login,
            ]);
        }
        $token->delete();
    }

}
