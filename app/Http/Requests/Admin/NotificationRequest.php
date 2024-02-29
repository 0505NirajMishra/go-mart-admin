<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class NotificationRequest extends FormRequest
{
    public function rules()
    {
        if (!request()->is('admin/notification/create')) {
            return [
                'notification_subject' => 'required|regex:/(^[A-Za-z ]+$)+/',
                'notification_send_to' => 'required',
                'notification_message' => 'required|max:200',
                'notification_date' => 'required',
            ];
        } else {
            return [
                'notification_subject' => 'required|regex:/(^[A-Za-z ]+$)+/',
                'notification_send_to' => 'required',
                'notification_message' => 'required|max:200',
                'notification_date' => 'required',
            ];
        }
    }

    public function messages()
    {
        return [
            'notification_subject.required' => __('validation.required', ['attribute' => 'Notification Subject']),
            'notification_send_to.required' => __('validation.required', ['attribute' => 'Send To']),
            'notification_message.required' => __('validation.required', ['attribute' => 'Message']),
            'notification_date.required' => __('validation.required', ['attribute' => 'Notification Date']),
        ];
    }
}