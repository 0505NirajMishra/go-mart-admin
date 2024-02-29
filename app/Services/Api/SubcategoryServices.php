<?php

namespace App\Services\Api;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SubcategoryServices
{

    public static function getSubcategory(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'category_id' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation fails',
                    'error' => $validator->errors(),
                ], 400);
            }

            $getData = DB::table('subcategorys')->where('category_id', $request->category_id)->get();

            if (count($getData) > 0) {
                return response()->json(
                    [
                        'status' => true,
                        'message' => 'Successfully',
                        'data' => $getData,
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

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }

    }

}
