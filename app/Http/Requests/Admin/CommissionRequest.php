<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CommissionRequest extends FormRequest
{
    public function rules()
    {
        if (!request()->is('admin/coupan/create')) {
            return [
                'commission_type' => 'required',
                'admin_commission' => 'required'
            ];
        } else {
            return [
                'commission_type' => 'required',
                'admin_commission' => 'required'
            ];
        }
    }

    public function messages()
    {
        return [
            'commission_type.required' => __('validation.required', ['attribute' => 'Commission Type']),
            'admin_commission.required' => __('validation.required', ['attribute' => 'Admin Commision']),
        ];
    }
}