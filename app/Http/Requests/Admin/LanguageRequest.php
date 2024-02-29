<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LanguageRequest extends FormRequest
{
    public function rules()
    {
        if (!request()->is('admin/language/create')) {
            return [
                'language_name' => 'required|regex:/(^[A-Za-z ]+$)+/',
                'language_slug' => 'required|min:2|max:3',
                'language_status' => 'required'
            ];
        } else {
            return [
                'language_name' => 'required|regex:/(^[A-Za-z ]+$)+/',
                'language_slug' => 'required|min:2|max:3',
                'language_status' => 'required'
            ];
        }
    }

    public function messages()
    {
        return [
            'language_name.required' => __('validation.required', ['attribute' => 'Language name']),
            'language_slug.required' => __('validation.required', ['attribute' => 'Language slug']),
            'language_status.required' => __('validation.required', ['attribute' => 'language status'])
        ];
    }
}