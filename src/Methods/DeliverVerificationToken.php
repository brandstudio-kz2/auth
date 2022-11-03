<?php

namespace BrandStudio\Auth\Methods;

use BrandStudio\Auth\AuthService;
use BrandStudio\Auth\Models\VerificationToken;
use BrandStudio\Auth\Jobs\SendSmsJob;
use BrandStudio\Auth\Jobs\SendMailJob;

class DeliverVerificationToken extends Base
{

    public static function execute(AuthService $authService, VerificationToken $token, $password = null)
    {
        if ($authService->getAuthFieldType($token->login) == 'phone') {
            SendSmsJob::dispatch(
                $authService->sms_service,
                $token->login,
                trans('brandstudio::auth.your_code', ['code' => $token->token])
            );
        } else {
            SendMailJob::dispatch(
                '\\BrandStudio\\Auth\\Mail\\AuthMail',
                $token,
                $authService->getTokenType($token),
                $password
            );
        }

    }

}
