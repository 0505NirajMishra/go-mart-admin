<?php

namespace App\Services\Api;

use App\Models\Checkout;
use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutService
{
    public static function Checkoutlist(Request $request)
    {
        $getItem = DB::table('checkout')->where('user_id',auth()->user()->id)->get();

        if ($getItem) {
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

    public static function Checkout(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'item_id' => 'required',
            'item_name' => 'required',
            'item_quantity' => 'required',
            'item_image' => 'required',
            'item_price' => 'required',
            'item_weight' => 'required',
            'item_dis_price' => 'required',
        ]);

        $ItemImage = FileService::fileUploaderWithoutRequest($request->item_image, 'checkout/image/');

        $checkout = Checkout::Create([
            'user_id' => $request->user_id,
            'item_id' => $request->item_id,
            'item_name' => $request->item_name,
            'item_price' => $request->item_price,
            'item_quantity' => $request->item_quantity,
            'item_image' => $ItemImage,
            'item_weight' => $request->item_weight,
            'item_dis_price' => $request->item_dis_price,
            'item_total' => $request->item_price * $request->item_quantity,
        ]);

        if ($checkout) {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Checkout Succesfully',
                    'data' => $checkout,
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