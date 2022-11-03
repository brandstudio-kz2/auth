<?php

namespace BrandStudio\Auth\Methods;

use BrandStudio\Auth\AuthService;
use Illuminate\Support\Facades\Hash;

class Register extends Base
{

    public static function execute(AuthService $authService, string $login, string $password, array $data)
    {
        $user = $authService->model::create(array_merge(['password' => Hash::make($password)], $data));
        $authService->createVerificationToken($user->id, $login);
        return $user;
    }

}
