<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class EditOrderRequest extends FormRequest
{
    
    public function rules()
    {
        if (!request()->is('admin/category/create')) {
            return [
                'order_amount' => 'required',
                'order_status' => 'required',
                'order_type' => 'required',
                'order_date' => 'required',
            ];
        } else {
            return [
                'order_amount' => 'required',
                'order_status' => 'required',
                'order_type' => 'required',
                'order_date' => 'required',
            ];
        }
    }

    public function messages()
    {
        return [
            'order_amount.required' => __('validation.required', ['attribute' => 'Order Amount']),
            'order_status.required' => __('validation.required', ['attribute' => 'Order Status']),
            'order_type.required' => __('validation.required', ['attribute' => 'Order Type']),
            'order_date.required' => __('validation.required', ['attribute' => 'Order Date']),
        ];
    }
}