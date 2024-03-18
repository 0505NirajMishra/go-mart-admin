<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class GlobalSettingRequest extends FormRequest
{
    public function rules()
    {
        if (!request()->is('admin/global/create')) {
            return [
                'application_name' => 'required|regex:/(^[A-Za-z ]+$)+/',
                'application_color' => 'required',
                'currency_code' => 'required|regex:/^[\pL\s\-]+$/u',
                'currency_symbol' => 'required',
                'currency_name' => 'required|regex:/(^[A-Za-z ]+$)+/',
                'address' => 'required|max:200',
                'email' => 'required|email',
                'phone' => 'required|max:10|min:10',
            ];
        } else {
            return [
                'application_name' => 'required|regex:/(^[A-Za-z ]+$)+/',
                'application_color' => 'required',
                'currency_code' => 'required|regex:/^[\pL\s\-]+$/u',
                'currency_symbol' => 'required',
                'currency_name' => 'required|regex:/(^[A-Za-z ]+$)+/',
                'address' => 'required|max:200',
                'email' => 'required|email',
                'phone' => 'required|max:10|min:10',
            ];
        }
    }

    public function messages()
    {
        return [
            'application_name.required' => __('validation.required', ['attribute' => 'Application Name']),
            'application_color.required' => __('validation.required', ['attribute' => 'Application Color']),
            'currency_code.required' => __('validation.required', ['attribute' => 'Currency Code']),
            'currency_symbol.required' => __('validation.required', ['attribute' => 'Currency Symbol']),
            'currency_name.required' => __('validation.required', ['attribute' => 'Currency']),
            'address.required' => __('validation.required', ['attribute' => 'Address']),
            'email.required' => __('validation.required', ['attribute' => 'Email']),
            'email.email' => __('validation.email', ['attribute' => 'Invalid Email']),
            'phone.required' => __('validation.required', ['attribute' => 'Phone']),
        ];
    }
}
