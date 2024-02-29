<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DriverpayoutRequest extends FormRequest
{
    public function rules()
    {
        if (!request()->is('admin/driverpayout/create')) {
            return [
                'driver_name' => 'required',
                'amount' => 'required',
                'note' => 'required|max:200'
            ];
        } else {
            return [
                'driver_name' => 'required',
                'amount' => 'required',
                'note' => 'required|max:200'
            ];
        }
    }

    public function messages()
    {
        return [
            'driver_name.required' => __('validation.required', ['attribute' => 'Driver name']),
            'amount.required' => __('validation.required', ['attribute' => 'Amount']),
            'note.required' => __('validation.required', ['attribute' => 'Note']),
        ];
    }
}