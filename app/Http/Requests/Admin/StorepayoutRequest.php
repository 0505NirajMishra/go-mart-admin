<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StorepayoutRequest extends FormRequest
{
    public function rules()
    {
        if (!request()->is('admin/storepayout/create')) {
            return [
                'store_name' => 'required',
                'amount' => 'required',
                'note' => 'required|max:200'
            ];
        } else {
            return [
                'store_name' => 'required',
                'amount' => 'required',
                'note' => 'required|max:200'
            ];
        }
    }

    public function messages()
    {
        return [
            'store_name.required' => __('validation.required', ['attribute' => 'Store name']),
            'amount.required' => __('validation.required', ['attribute' => 'Amount']),
            'note.required' => __('validation.required', ['attribute' => 'Note']),
        ];
    }
}