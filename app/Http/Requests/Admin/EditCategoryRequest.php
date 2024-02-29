<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class EditCategoryRequest extends FormRequest
{
    public function rules()
    {
        if (!request()->is('admin/category/create')) {
            return [
                'category_name' => 'required|regex:/(^[A-Za-z ]+$)+/',
                'description' => 'required|max:200',
            ];
        } else {
            return [
                'category_name' => 'required|regex:/(^[A-Za-z ]+$)+/',
                'description' => 'required|max:200',
            ];
        }
    }

    public function messages()
    {
        return [
            'category_name.required' => __('validation.required', ['attribute' => 'Catgeory Name']),
            'description.required' => __('validation.required', ['attribute' => 'Description']),
        ];
    }
}