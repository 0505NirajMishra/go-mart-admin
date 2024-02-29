<?php

namespace App\Services\Api;

use App\Models\Reviewandrating;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RatingService
{

    public static function addRating(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'order_review' => 'required',
                'rating' => 'required|numeric|min:1|max:5',
                'store_id' => 'required',
                'order_id' => 'required',
                'item_id' => 'required',
                'user_id' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation fails',
                    'error' => $validator->errors(),
                ], 400);
            }

            $AddratingInput = [
                'item_id' => $request->item_id,
                'user_id' => Auth::user()->id,
                'store_id' => $request->store_id,
                'order_id' => $request->order_id,
                'order_review' => $request->order_review,
                'rating' => round($request->rating),
            ];

            $addOrder = Reviewandrating::create($AddratingInput);

            if ($addOrder) {
                return response()->json(
                    [
                        'status' => true,
                        'message' => 'Add Review Successfully',
                        'ReviewData' => $addOrder,
                    ],
                    200
                );
            } else {
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'Review Not Added',
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