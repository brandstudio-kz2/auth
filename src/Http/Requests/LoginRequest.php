<?php

namespace BrandStudio\Auth\Http\Requests;


class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        // TODO: check if auth_field enabled

        return [
            'login' => config('brandstudio.auth.login_requirements'),
            'password' => 'required',
        ];
    }
}
