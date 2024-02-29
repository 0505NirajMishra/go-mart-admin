<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RadiusRequest extends FormRequest
{
    public function rules()
    {
        if (!request()->is('admin/radius/create')) {
            return [
                'store_nearby' => 'required',
                'radius_nearby' => 'required'
            ];
        } else {
            return [
                'store_nearby' => 'required',
                'radius_nearby' => 'required'
            ];
        }
    }

    public function messages()
    {
        return [
            'store_nearby.required' => __('validation.required', ['attribute' => 'Store Nearby']),
            'radius_nearby.required' => __('validation.required', ['attribute' => 'Radius Nearby']),
        ];
    }
}