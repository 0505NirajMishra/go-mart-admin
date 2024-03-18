<?php

namespace App\Services\Api;

use App\Models\Adduseraddress;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AddaddressService
{

    public static function useraddress(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'address' => 'required',
                'zip' => 'required',
                'city' => 'required',
                'address_type' => 'required',
                'building' => 'required',
                // 'other_address' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation fails',
                    'error' => $validator->errors(),
                ], 400);
            }

            $addressinput = [
                'user_id' => auth()->user()->id,
                'address' => $request->address,
                'zip' => $request->zip,
                'city' => $request->city,
                'address_type' => $request->address_type,
                'building' => $request->building,
                'other_address' => $request->other_address
            ];

            $add = Adduseraddress::create($addressinput);

            if ($add) {
                return response()->json(
                    [
                        'status' => true,
                        'message' => 'Address Add Successfully',
                        'data' => $add,
                    ],
                    200
                );
            } else {
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'not updated',
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

    public static function listuseraddress(Request $request)
    {
        try {

            $add = Adduseraddress::get();

            if ($add) {
                return response()->json(
                    [
                        'status' => true,
                        'message' => 'Data Find Successfully',
                        'data' => $add,
                    ],
                    200
                );
            } else {
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'not updated',
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
