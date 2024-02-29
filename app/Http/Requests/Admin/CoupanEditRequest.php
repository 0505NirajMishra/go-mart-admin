<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CoupanEditRequest extends FormRequest
{
    public function rules()
    {
        if (!request()->is('admin/coupan/create')) {
            return [
                'discount' => 'required',
                'expiry_date' => 'required',
                'coupan_status' => 'required',
                'discount_type' => 'required',
                'store_id' => 'required',
                'coupan_title'=> 'required|regex:/(^[A-Za-z ]+$)+/',
                'coupon_desc' => 'required|max:200',
            ];
        } else {
            return [
                'discount' => 'required',
                'expiry_date' => 'required',
                'coupan_status' => 'required',
                'discount_type' => 'required',
                'store_id' => 'required',
                'coupan_title'=> 'required|regex:/(^[A-Za-z ]+$)+/',
                'coupon_desc' => 'required|max:200',
            ];
        }
    }

    public function messages()
    {
        return [
            'amount.required' => __('validation.required', ['attribute' => 'Amount']),
            'discount.required' => __('validation.required', ['attribute' => 'Discount']),
            'expiry_date.required' => __('validation.required', ['attribute' => 'Expiry Date']),
            'coupan_status.required' => __('validation.required', ['attribute' => 'Coupan Status']),
            'coupan_title.required' => __('validation.required', ['attribute' => 'Coupan Title']),
            'coupan_status.required' => __('validation.required', ['attribute' => 'Coupan Status']),
            'store_id.required' => __('validation.required', ['attribute' => 'Store Name']),
            'coupon_desc.required' => __('validation.required', ['attribute' => 'Coupon Description']),
        ];
    }
}
