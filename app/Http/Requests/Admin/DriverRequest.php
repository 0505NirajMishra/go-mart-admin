<?php

namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DriverRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

    public function rules()
    {
        if (!request()->is('admin/driver/create')) {
            return [
                'driver_name' => 'required|regex:/(^[A-Za-z ]+$)+/',
                'store_name' => 'required',
                'driver_image' => 'required',
                'driver_phone_number' => 'required|max:10|min:10',
                'driver_email' => 'required|email',
                'driver_address' => 'required|max:200',
                'driver_status' => 'required',
                'driver_longitude' => 'required|regex:/^[0-9]+(\.[0-9]+)?$/',
                'driver_latitude' => 'required|regex:/^[0-9]+(\.[0-9]+)?$/',
                'car_number' => 'required|regex:/^[A-Za-z0-9 -]+$/',
                'car_name' => 'required|regex:/(^[A-Za-z ]+$)+/',
                'car_image' => 'required',
                'car_image' => 'required',
                'bank_name' => 'required|regex:/(^[A-Za-z ]+$)+/',
                'branch_name' => 'required|regex:/(^[A-Za-z ]+$)+/',
                'holder_name' => 'required|regex:/(^[A-Za-z ]+$)+/',
                'account_number' => 'required|min:9|max:18|regex:/^[0-9]+$/',
                'other_info' => 'required|regex:/(^[A-Za-z0-9 ]+$)+/'
            ];
        } else {
            return [
                'driver_name' => 'required|regex:/(^[A-Za-z ]+$)+/',
                'store_name' => 'required',
                'driver_image' => 'required',
                'driver_phone_number' => 'required|max:10|min:10',
                'driver_email' => 'required|email',
                'driver_address' => 'required|max:200',
                'driver_status' => 'required',
                'driver_longitude' => 'required|regex:/^[0-9]+(\.[0-9]+)?$/',
                'driver_latitude' => 'required|regex:/^[0-9]+(\.[0-9]+)?$/',
                'car_number' => 'required|regex:/^[A-Za-z0-9 -]+$/',
                'car_name' => 'required|regex:/(^[A-Za-z ]+$)+/',
                'car_image' => 'required',
                'bank_name' => 'required|regex:/(^[A-Za-z ]+$)+/',
                'branch_name' => 'required|regex:/(^[A-Za-z ]+$)+/',
                'holder_name' => 'required|regex:/(^[A-Za-z ]+$)+/',
                'account_number' => 'required|min:9|max:18|regex:/^[0-9]+$/',
                'other_info' => 'required|regex:/(^[A-Za-z0-9 ]+$)+/'
            ];
        }
    }

    public function messages()
    {
        return [
            'driver_name.required' => __('validation.required', ['attribute' => 'Driver Name']),
            'store_name.required' => __('validation.required', ['attribute' => 'Store Name']),
            'driver_image.required' => __('validation.required', ['attribute' => 'Driver Image']),
            'driver_phone_number.required' => __('validation.required', ['attribute' => 'Driver phone number']),
            'driver_email.required' => __('validation.required', ['attribute' => 'Driver Email']),
            'driver_email.email' => __('validation.email', ['attribute' => 'Valid Email Address']),
            'driver_address.required' => __('validation.required', ['attribute' => 'Driver Address']),
            'driver_status.required' => __('validation.required', ['attribute' => 'Driver Status']),
            'driver_latitude.required' => __('validation.required', ['attribute' => 'Driver Latitude']),
            'driver_longitude.required' => __('validation.required', ['attribute' => 'Driver Longitude']),
            'car_number.required' => __('validation.required', ['attribute' => 'Car Number']),
            'car_name.required' => __('validation.required', ['attribute' => 'Car Name']),
            'bank_name.required' => __('validation.required', ['attribute' => 'Bank Name']),
            'branch_name.required' => __('validation.required', ['attribute' => 'Branch Name']),
            'holder_name.required' => __('validation.required', ['attribute' => 'Holder Name']),
            'account_number.required' => __('validation.required', ['attribute' => 'Account Number']),
            'other_info.required' => __('validation.required', ['attribute' => 'Other Info'])
        ];
    }
}