<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApiLoginRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required',
            'password' => 'required',
            'login_type' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => __('validation.required', ['attribute' => 'Email']),
            'email.unique' => __('validation.unique', ['attribute' => 'Email']),
            'email.exists' => "This Email doesn't registered with us.",
            'password.required' => __('validation.required', ['attribute' => 'Password']),
            'login_type.required' => __('validation.required', ['attribute' => 'Login Type']),
        ];
    }
}