<?php

namespace App\Services\Api;

use Illuminate\Support\Facades\DB;

class Bannerservice
{

    public static function getBanner()
    {

        $getItem = DB::table('banners')->get();

        if (count($getItem) > 0) {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Successfully',
                    'data' => $getItem,
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Found',
                    'data' => [],
                ],
                200
            );
        }

    }
}