<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ContactUsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if (!request()->is('admin/contactus/create')) {
            return [
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'messages' => 'required',

                
            ];
        } else {
            return [
                'name' => 'required',
                'email' => 'required|email|unique:contact_us,email',
                'phone' => 'required|numeric|min:9|unique:contact_us,phone',
                'messages' => 'required',

            ];
        }
    }

    public function messages()
    {
        return [
            'name.required' => __('validation.required', ['attribute' => 'User Name']),
            'email.required' => __('validation.required', ['attribute' => 'Email']),
            'email.email' => __('validation.email', ['attribute' => 'Email']),
            'email.unique' => __('validation.unique', ['attribute' => 'Email']),
            'phone.required' => __('validation.required', ['attribute' => 'Phone']),
            'messages.required' => __('validation.required', ['attribute' => 'Message']),

          
        ];
    }
}
