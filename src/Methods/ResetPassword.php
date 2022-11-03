<?php

namespace BrandStudio\Auth\Methods;

use BrandStudio\Auth\AuthService;
use BrandStudio\Auth\Jobs\SendSmsJob;
use Illuminate\Support\Facades\Hash;

class ResetPassword extends Base
{

    public static function execute(AuthService $authService, string $login)
    {
        $user = $authService->getUser($login);
        if ($authService->getAuthFieldType($login) == 'phone') {
            $password = $authService->generatePassword();

            $user->update([
                'password' => Hash::make($password),
            ]);
            SendSmsJob::dispatch($authService->sms_service, $login, trans('brandstudio::auth.your_password', ['password' => $password]));

        } else {
            $authService->createVerificationToken($user->id, $login, $authService->generatePassword());
        }
    }

}
