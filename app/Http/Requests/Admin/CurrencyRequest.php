<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CurrencyRequest extends FormRequest
{
    public function rules()
    {
        if (!request()->is('admin/currency/create')) {
            return [
                'name' => 'required|regex:/(^[A-Za-z ]+$)+/',
                'code' => 'required|min:3|max:3|regex:/(^[A-Za-z ]+$)+/',
                'symbol' => 'required',
                'symbol_at_right' => 'required',
                'currency_status' => 'required'
            ];
        } else {
            return [
                'name' => 'required|regex:/(^[A-Za-z ]+$)+/',
                'code' => 'required|min:3|max:3|regex:/(^[A-Za-z ]+$)+/',
                'symbol' => 'required',
                'symbol_at_right' => 'required',
                'currency_status' => 'required'
            ];
        }
    }

    public function messages()
    {
        return [
            'name.required' => __('validation.required', ['attribute' => 'Currency Name']),
            'code.required' => __('validation.required', ['attribute' => 'Currency Code ']),
            'symbol.required' => __('validation.required', ['attribute' => 'Currency Symbol']),
            'symbol_at_right.required' => __('validation.required', ['attribute' => 'Currency Symbol At Right']),
            'currency_status.required' => __('validation.required', ['attribute' => 'Currency Status']),
        ];
    }
}