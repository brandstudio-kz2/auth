<?php

namespace BrandStudio\Auth\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use BrandStudio\Auth\Http\Requests\RegisterRequest;
use BrandStudio\Auth\Http\Requests\LoginRequest;
use BrandStudio\Auth\Http\Requests\UpdateLoginRequest;
use BrandStudio\Auth\Http\Requests\ResetPasswordRequest;
use BrandStudio\Auth\Http\Requests\UpdatePasswordRequest;
use BrandStudio\Auth\Http\Requests\VerifyTokenRequest;
use Illuminate\Http\Request;
use BrandStudio\Auth\Facades\BsAuth;

class AuthController extends BaseController
{

    public function getUser(Request $request)
    {
        return response()->json($request->user()->toAuthResponse());
    }

    public function register(RegisterRequest $request)
    {
        $data = \Arr::except(
            $request->toArray(),
            array_merge(
                ['login', 'password'],
                config('brandstudio.auth.auth_fields')
            )
        );
        $user = BsAuth::register($request->login, $request->password, $data);
        foreach(config('brandstudio.auth.auth_fields') as $field) {
            if ($request->{$field}) {
                BsAuth::updateLogin($user, $request->{$field});
            }
        }
        return response()->json([
            'success' => true,
            'message' => trans('brandstudio::auth.success_registartion'),
        ])->setStatusCode(201);
    }

    public function login(LoginRequest $request)
    {
        return BsAuth::login($request->login, $request->password);
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        BsAuth::resetPassword($request->login);
        return response()->json([
            'success' => true,
            'message' => trans('brandstudio::auth.success_reset_password'),
        ])->setStatusCode(201);
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        BsAuth::updatePassword($request->user(), $request->password, $request->new_password);
        return response()->json([
            'success' => true,
            'message' => trans('brandstudio::auth.success_update_password'),
        ]);
    }

    public function updateLogin(UpdateLoginRequest $request)
    {
        BsAuth::updateLogin($request->user(), $request->login);
        return response()->json([
            'success' => true,
            'message' => trans('brandstudio::auth.success_update_login'),
        ])->setStatusCode(201);
    }

    public function verify(VerifyTokenRequest $request)
    {
        BsAuth::verify($request->login, $request->token);
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => trans('brandstudio::auth.success_verification'),
            ]);
        }
        return redirect(config('brandstudio.auth.redirect_url'));
    }

    public function delete(Request $request)
    {
        $request->user()->delete();
        return response()->json([
            'success' => true,
            'message' => trans('brandstudio::auth.success_user_delete'),
        ]);
    }

}
