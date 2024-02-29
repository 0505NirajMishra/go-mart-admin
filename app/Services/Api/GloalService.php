<?php

namespace App\Services\Api;

use App\Models\Globalsetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class GloalService
{

    public static function getsettingdata(Request $request)
    {
            $getData = Globalsetting::get();
            
            if (count($getData)>0) {
                return response()->json(
                    [
                        'status' => true,
                        'message' => 'Successfully',
                        'data' => $getData
                    ],
                    200
                );
            } 
            else 
            {
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'Data not Found',
                        'data' =>[],
                    ],
                    200
                );
            }

    }

}