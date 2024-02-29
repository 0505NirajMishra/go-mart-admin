<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DeliverRequest extends FormRequest
{
    public function rules()
    {
        if (!request()->is('admin/deliverycharge/create')) {
            return [
                'delivery_charge_per_km' => 'required',
                'minimum_delivery_charge' => 'required',
                'minimum_delivery_charge_with_km' => 'required'
            ];
        } else {
            return [
                'delivery_charge_per_km' => 'required',
                'minimum_delivery_charge' => 'required',
                'minimum_delivery_charge_with_km' => 'required'
            ];
        }
    }

    public function messages()
    {
        return [
            'delivery_charge_per_km.required' => __('validation.required', ['attribute' => 'Delivery charge per km']),
            'minimum_delivery_charge.required' => __('validation.required', ['attribute' => 'Minimum delivery charge']),
            'minimum_delivery_charge_with_km.required' => __('validation.required', ['attribute' => 'Minimum delivery charge with km']),
        ];
    }
}