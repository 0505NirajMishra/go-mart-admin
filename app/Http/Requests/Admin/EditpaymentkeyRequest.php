<?php

namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;

class EditpaymentkeyRequest extends FormRequest
{
    public function rules()
    {
        if (!request()->is('admin/payment/create')) {
            return [
                'razorpay_status' => 'required',
                'sandbox_mode_status' => 'required',
                'razorpay_key' => 'required',
                'razorpay_secret' => 'required'
            ];
        } else {
            return [
                'razorpay_status' => 'required',
                'sandbox_mode_status' => 'required',
                'razorpay_key' => 'required',
                'razorpay_secret' => 'required'
            ];
        }
    }

    public function messages()
    {
        return [
            'razorpay_status.required' => __('validation.required', ['attribute' => 'Razorpay Status']),
            'sandbox_mode_status.required' => __('validation.required', ['attribute' => 'Sandbox Mode Status']),
            'razorpay_key.required' => __('validation.required', ['attribute' => 'Key']),
            'razorpay_secret.required' => __('validation.required', ['attribute' => 'Secret Key'])
        ];
    }
}