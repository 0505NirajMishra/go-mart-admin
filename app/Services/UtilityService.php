<?php

namespace App\Services;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Hash;

class UtilityService
{
    public static function is200Response($responseMessage)
    {
        throw new HttpResponseException(response()->json([
            'status' => true,
            'message' => $responseMessage
        ], 200));
    }


    public static function is200ResponseWithData($responseMessage, $data)
    {
        throw new HttpResponseException(response()->json([
            'status' => true,
            'data' => $data,
            'message' => $responseMessage
        ], 200));
    }

    public static function is200ResponseWithDataArrKey($responseMessage, $data)
    {
        throw new HttpResponseException(response()->json([
            'status' => true,
            'data' => [
                'data' => $data,
            ],
            'message' => $responseMessage
        ], 200));
    }

    public static function is200ResponseWithDataWithExtra($responseMessage, $data, $extra_key, $extra_value)
    {
        throw new HttpResponseException(response()->json([
            'status' => true,
            $extra_key => $extra_value,
            'data' => $data,
            'message' => $responseMessage
        ], 200));
    }

    public static function is422Response($responseMessage)
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'message' => $responseMessage
        ], 422));
    }

    public static function is422ResponseWithData($responseMessage, $data)
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'data' => $data,
            'message' => $responseMessage
        ], 422));
    }


    public static function is500Response($responseMessage)
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'error' => $responseMessage,
            'message' => $responseMessage
        ], 500));
    }

    public static function is401Response($responseMessage)
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'type' => 'unauthorized',
            'message' => $responseMessage
        ], 401));
    }


    public static function hash_password($value)
    {
        return Hash::make($value);
    }

    public static function responseMsg()
    {
        return
            [
                'success_msg' => 'Data Get Successfully',
                'success_add_msg' => 'Data Created Successfully',
                'success_update_msg' => 'Data Update Successfully',
                'success_status_update_msg' => 'Status Update Successfully',
                'success_delete_msg' => 'Data Deleted Successfully',
                'no_records_msg' => 'No Records Found',
                'error_msg' => 'Error! Please contact to support team',
                'incorrect_key' => 'Incorect key Provided.',
            ];
    }

    public static function returnJsonWithResponseMsg($data)
    {
        //messages
        $responseMsg = self::responseMsg();
        if ($data) {
            return self::is200Response($responseMsg['success_add_msg']);
        } else {
            return self::is422Response($responseMsg['error_msg']);
        }
    }

    public static function jsonResponse($status, $message, $status_name)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'status_name' => $status_name,
        ]);
    }

    public static function jsonResponseWithTitle($status, $message, $status_name, $title = '')
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'status_name' => $status_name,
            'title' => $title
        ]);
    }

    public static function swalResponse($result, $key, $value)
    {
        $mls = new ManagerLanguageService('messages');
        if ($result) {
            return self::jsonResponse(1, $mls->messageLanguage($key, $value, 1), 'success');
        } else {
            return self::jsonResponse(0, $mls->messageLanguage('not_' . $key, $value, 1), 'error');
        }
    }

    public static function swalWithTitleResponse($result, $key, $value)
    {
        $mls = new ManagerLanguageService('messages');
        if ($result) {
            return self::jsonResponseWithTitle(1, $mls->messageLanguage($key, $value, 1), 'success', $mls->onlyNameLanguage($key));
        } else {
            return self::jsonResponseWithTitle(0, $mls->messageLanguage('not_' . $key, $value, 1), 'error', $mls->onlyNameLanguage('not_' . $key));
        }
    }
}