<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class VatRequest extends FormRequest
{
    public function rules()
    {
        if (!request()->is('admin/vat/create')) {
            return [
                'vat_lable' => 'required|regex:/(^[A-Za-z ]+$)+/',
                'vat_tax' => 'required',
                'vat_type' => 'required'
            ];
        } else {
            return [
                'vat_lable' => 'required|regex:/(^[A-Za-z ]+$)+/',
                'vat_tax' => 'required',
                'vat_type' => 'required'
            ];
        }
    }

    public function messages()
    {
        return [
            'vat_lable.required' => __('validation.required', ['attribute' => 'Vat Lable']),
            'vat_tax.required' => __('validation.required', ['attribute' => 'Vat Tax']),
            'vat_type.required' => __('validation.required', ['attribute' => 'Vat Type']),
        ];
    }
}