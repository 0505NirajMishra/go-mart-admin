<?php

namespace App\Services;

use App\Models\Banner;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;


class ForgotPasswordService
{
    
    public static function send_forgetmail(array $detail, $request)
    {
        try{
        $details = [
            'title' => $detail['title'],
            'body' => $detail['body'],
            'url'=>$detail['url'],
        ];
       
        $data=Mail::to($request)->send(new \App\Mail\ForgetEmail($details));
        return $data;
    }
    catch(\Exception $e){   
            return; 
        }

    }
}