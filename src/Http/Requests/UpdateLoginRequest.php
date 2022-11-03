<?php

namespace BrandStudio\Auth\Http\Requests;

class UpdateLoginRequest extends FormRequest
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
        return [
            'login' => $this->getLoginRules(),
            // 'password' => 'required',
        ];
    }

    private function getLoginRules() : string
    {
        $rules = rtrim(config('brandstudio.auth.login_requirements'), '|');

        $model = config('brandstudio.auth.model');
        $users_table = (new $model)->getTable();

        foreach(config('brandstudio.auth.auth_fields') as $field) {
            $rules.="|unique:{$users_table},{$field}";
        }

        return $rules;
    }

}
