<?php

namespace BrandStudio\Auth\Http\Requests;

use Illuminate\Foundation\Http\FormRequest as Form;

abstract class FormRequest extends Form
{
    public function messages()
    {
        return [
            'login.required' => trans('brandstudio::auth.login_required'),
            'login.email_phone' => trans('brandstudio::auth.login_email_phone'),
            'token' => trans('brandstudio::auth.token_required'),
            'password.required' => trans('brandstudio::auth.password_required'),
            'password.min' => trans('brandstudio::auth.password_min'),
            'login.unique' => trans('brandstudio::auth.login_unique'),
        ];
    }
}
