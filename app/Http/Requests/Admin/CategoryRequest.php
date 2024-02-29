<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;


class CategoryRequest extends FormRequest
{
    public function rules()
    {
        if (!request()->is('admin/category/create')) {
            return [
                'category_name' => 'required|regex:/(^[A-Za-z ]+$)+/',
                'category_image' => 'required',
                'description' => 'required|max:200',
            ];
        } else {
            return [
                'category_name' => 'required|regex:/(^[A-Za-z ]+$)+/',
                'category_image' => 'required',
                'description' => 'required|max:200',
            ];
        }
    }

    public function messages()
    {
        return [
            'category_name.required' => __('validation.required', ['attribute' => 'Category Name']),
            'category_image.required' => __('validation.required', ['attribute' => 'Category Image']),
            'description.required' => __('validation.required', ['attribute' => 'Description']),
        ];
    }
}