<?php

namespace App\Services\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Coupan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Models\Cart;
use App\Models\Promocode_and_cartitem;

class CouponCodeService
{
    // public static function addCouponcode(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'coupan_id' => 'required',
    //     ]);

    //     if ($validator->fails())
    //     {
    //         return response()->json([
    //             'message' => 'Validation fails',
    //             'error' => $validator->errors(),
    //         ], 400);
    //     }

    //     $getCodeData = DB::table('coupans')->where('coupan_id', $request->coupan_id)->first();
    //     // $getCartDatabyuser = DB::table('cart_items')->where('user_id', auth()->user()->id)->get();
    //     // if ($getCartDatabyuser)
    //     // {
    //     //     foreach ($getCartDatabyuser as $obj) {
    //     //         DB::table('cart_items')->where('item_id', $obj->item_id)->update(['coupan_id' => $getCodeData->coupan_id]);
    //     //     }
    //     // }

    //     if ($getCodeData) {
    //         return response()->json(
    //             [
    //                 'status' => true,
    //                 'message' => 'Add Successfully',
    //                 'Data' => $getCodeData,
    //             ],
    //             200
    //         );
    //     } else {
    //         return response()->json(
    //             [
    //                 'status' => true,
    //                 'message' => 'Data Not Found',
    //                 'Data' => $getCodeData,
    //             ],
    //             200
    //         );
    //     }

    // }

    public static function getCouponcode(Request $request)
    {
        $getCouponCode = DB::table('coupans')->where(['coupan_status' => 0])->get();

        if (count($getCouponCode) > 0) {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Successfully',
                    'data' => $getCouponCode,
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

    public static function RemoveCouponcode(Request $request)
    {
        $request->validate([
            'coupan_id' => 'required',
        ]);

        $deleteCouponCode = DB::table('coupans')->where('coupan_id', $request->coupan_id)->delete();

        if ($deleteCouponCode) {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Deleted Successfully',
                    'data' => $deleteCouponCode,
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

    public static function getCouponcodeByid(Request $request)
    {
        $request->validate([
            'coupan_id' => 'required|integer',
        ]);

        $getCouponCodeByid = DB::table('coupans')->where(['coupan_id' => $request->coupan_id])->get();

        if (count($getCouponCodeByid) > 0) {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Successfully',
                    'data' => $getCouponCodeByid,
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
    
    public static function applycouponcode(Request $request)
    {

        $request->validate([
            'coupon_code' => 'required',
        ]);

        $coupon = Coupan::where(['coupan_code' => $request->coupon_code, 'coupan_status' => 0])->first();
        
        if ($coupon && $coupon->expiry_date && Carbon::now()->gt($coupon->expiry_date))
        {
            return response()->json(['message' => 'Coupon has expired'], 400);
        }

        if ($coupon) {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Successfully',
                    'data' => $coupon,
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
