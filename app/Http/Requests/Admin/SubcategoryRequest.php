<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SubcategoryRequest extends FormRequest
{
    public function rules()
    {
        if (!request()->is('admin/subcategory/create')) {
            return [
                'subcategory_name' => 'required|regex:/(^[A-Za-z ]+$)+/',
                'subcategory_image' => 'required',
                'subcategory_desc' => 'required|max:200',
                'category_id' => 'required',
            ];
        } else {
            return [
                'subcategory_name' => 'required|regex:/(^[A-Za-z ]+$)+/',
                'subcategory_image' => 'required',
                'subcategory_desc' => 'required|max:200',
                'category_id' => 'required',
            ];
        }
    }

    public function messages()
    {
        return [
            'subcategory_name.required' => __('validation.required', ['attribute' => 'Subcategory Name']),
            'subcategory_image.required' => __('validation.required', ['attribute' => 'Subcategory Image']),
            'subcategory_desc.required' => __('validation.required', ['attribute' => 'Subcategory Description']),
            'category_id.required' => __('validation.required', ['attribute' => 'Category Name']),
        ];
    }
}