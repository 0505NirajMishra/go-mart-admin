<?php

namespace App\Services\Api;

use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\Constraint\Count;

class ItemService
{
    public static function getProduct()
    {

        $getItem = DB::table('items')->where('item_publish', 'Yes')->get();

        foreach ($getItem as $data) {
            $data->total_amount = $data->item_price * $data->quantity;

            $likestatus = UserService::checklikestatus($data->item_id, auth()->user()->id);
            if ($likestatus == null) {
                $data->like_status = 0;
            } else {
                $data->like_status = $likestatus->like_status;
            }

        }

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
// New Code
        // $userId = auth()->user()->id;

        // $getItem = DB::table('items')
        //     ->leftJoin('favorites', function ($join) use ($userId) {
        //         $join->on('items.item_id', '=', 'favorites.item_id')
        //             ->where('favorites.user_id', '=', $userId);
        //     })
        //     ->select('items.*', DB::raw('IFNULL(favorites.like_status,0) as like_status'))
        //     ->where('item_publish', 'Yes')
        //     ->get();

        // foreach ($getItem as $data) {
        //     $data->total_amount = $data->item_price * $data->quantity;
        // }

        // if (count($getItem) > 0) {
        //     return response()->json(
        //         [
        //             'status' => true,
        //             'message' => 'Successfully',
        //             'data' => $getItem,
        //         ],
        //         200
        //     );
        // } else {
        //     return response()->json(
        //         [
        //             'status' => false,
        //             'message' => 'Data not Found',
        //             'data' => [],
        //         ],
        //         200
        //     );
        // }

    }

    public static function getProductByCatID(Request $request)
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

            $getProductByCatId['product'] = DB::table('items')->where('items.category_id', $request->category_id)->get();

            foreach ($getProductByCatId['product'] as $rating)
            {
                $rating->rating_view = DB::table('reviewandratings')->where('item_id', $rating->item_id)->avg('rating');

                $likestatus = UserService::checklikestatus($rating->item_id, auth()->user()->id);

                if ($likestatus == null) {
                    $rating->like_status = 0;
                } else {
                    $rating->like_status = $likestatus->like_status;
                }

            }

            if (count($getProductByCatId) > 0) {
                return response()->json(
                    [
                        'status' => true,
                        'message' => 'Successfully',
                        'data' => $getProductByCatId,
                    ],
                    200
                );
            } else {
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'Data not Found'
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

    public static function getProductByItemID(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'item_id' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation fails',
                    'error' => $validator->errors(),
                ], 400);
            }

            $getProductByCatId['product'] = DB::table('items')->where('items.item_id', $request->item_id)->get();

            foreach ($getProductByCatId['product'] as $rating) {
                $rating->rating_view = DB::table('reviewandratings')
                    ->where('item_id', $rating->item_id)->avg('rating');


                $likestatus = UserService::checklikestatus($rating->item_id,auth()->user()->id);

                if ($likestatus == null) {
                    $rating->like_status = 0;
                } else {
                    $rating->like_status = $likestatus->like_status;
                }



            }

            if (count($getProductByCatId) > 0) {
                return response()->json(
                    [
                        'status' => true,
                        'message' => 'Find Successfully',
                        'data' => $getProductByCatId,
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
