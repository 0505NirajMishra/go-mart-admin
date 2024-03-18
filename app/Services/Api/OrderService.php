<?php

namespace App\Services\Api;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class OrderService
{
    public static function addOrder(Request $request)
    {
        try {

            $validatedData = $request->validate([
                'items' => 'required|array|min:1',
                'items.*.item_id' => 'required',
                'items.*.item_name' => 'required',
                'items.*.item_quantity' => 'required|integer|min:1',
                'items.*.item_price' => 'required|integer|min:1',
                'order_amount' => 'required',
                'order_type' => 'required',
                'payment_method' => 'required',
                'address' => 'required',
            ]);

            $currentDate = Date::now()->format('m/d/Y');
            $currentDateInIST = Date::now('Asia/Kolkata');
            $currentFormattedTime = $currentDateInIST->format('g:ia');
            $randomString = Str::random(8);
            $orderNumber = $randomString;

            $OrderInput = [
                'order_no' => $orderNumber,
                'user_id' => Auth::user()->id,
                'order_date' => $currentDate,
                'order_time' => $currentFormattedTime,
                'order_amount' => $validatedData['order_amount'],
                'order_type' => $validatedData['order_type'],
                'payment_method' => $validatedData['payment_method'],
                'coupon_id' => $request->coupon_id,
                'address' => $validatedData['address'],
                'order_status' => 0,
            ];

            $addOrder = Order::create($OrderInput);

            foreach ($validatedData['items'] as $newdata) {
                $newdatainput = [
                    'order_no' => $addOrder['order_no'],
                    'item_id' => $newdata['item_id'],
                    'item_name' => $newdata['item_name'],
                    'item_price' => $newdata['item_price'],
                    'quantity' => $newdata['item_quantity'],
                ];
                OrderItem::create($newdatainput);

                $updatestatus = [
                    'purchased_status' => 0,
                ];

                $updatethepurchasestatus =
                Cart::where([
                    'user_id' => auth()->user()->id,
                    'item_id' => $newdata['item_id']])
                    ->delete();

            }

            // $data = [
            //     'order_id' => $addOrder->order_id,
            //     'item_id' => $OrderInput['items']['item_id'],
            // ];
            // $screen = 0;
            // $input = [
            //     'notification' => 'Order Purchase',
            //     'message' => 'You Order Purchase',
            //     'user_id' => auth()->user()->id,
            //     'order_id' => $request->order_id,
            // ];
            // NotificationService::create($input, $screen);

            if ($addOrder) {
                return response()->json(
                    [
                        'status' => true,
                        'message' => 'Order Add Successfully',
                        'OrderData' => $addOrder,
                    ],
                    200
                );
            } else {
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'Order Not Added',
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

    public static function cancelOrder(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'order_no' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation fails',
                    'error' => $validator->errors(),
                ], 400);
            }

            $input['order_status'] = 2;

            $result = DB::table('orders')->where('order_no', $request->order_no)->update($input);

            if ($result) {
                return response()->json(
                    [
                        'status' => true,
                        'message' => 'Order Cancel Successfully',
                    ],
                    200
                );
            } else {
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'Data not cancel',
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

    public static function deleteorder(Request $request)
    {

        try {

            $validator = Validator::make($request->all(), [
                'order_no' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation fails',
                    'error' => $validator->errors(),
                ], 400);
            }

            $orderdelete = DB::table('orders')
                ->where('order_no', $request->order_no)->delete();

            if ($orderdelete) {
                return response()->json(
                    [
                        'status' => true,
                        'message' => 'Order Deleted Successfully',
                        'Order' => $orderdelete,
                    ],
                    200
                );
            } else {
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'Order Not Added',
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

    public static function getOrderdetail(Request $request)
    {
        try {

            $getData = DB::table('orders')
                ->join('users', 'users.id', '=', 'orders.user_id')
                ->select('orders.*', 'users.name')
                ->where('users.id',auth()->user()->id)
                ->get();

            if ($getData) {
                return response()->json(
                    [
                        'status' => true,
                        'message' => 'Order Find Successfully',
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

    public static function OrderStatusUpdate(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'order_no' => 'required',
                'order_status' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation fails',
                    'error' => $validator->errors(),
                ], 400);
            }

            $data['order_status'] = $request->order_status;

            $result = DB::table('orders')
                ->where('order_status', $request->order_no)->update($data);

            if ($result) {
                return response()->json(
                    [
                        'status' => true,
                        'message' => 'Order Updated Successfully',
                    ],
                    200
                );
            } else {
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'Data not Updated',
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

    public static function getOrderByOrderNo(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'order_no' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation fails',
                    'error' => $validator->errors(),
                ], 400);
            }

            $result = DB::table('order_items')
                ->join('orders', 'orders.order_no', '=', 'order_items.order_no')
                ->join('users', 'users.id', '=', 'orders.user_id')
                ->select(
                    'orders.*', 'order_items.*',
                    'users.name as user_name')
                ->where('order_items.order_no', '=', $request->order_no)
                ->get();

            $total = [];

            $coupon = 0;

            foreach ($result as $data) {

                $product_image = DB::table('items')->select('item_image')->where('item_id', $data->item_id)->first();
                $imagedata = $product_image;

                $data->product_image = $imagedata;

                if ($data->product_image != null) {
                    $data->product_image = $imagedata->item_image;
                } else {
                    $data->product_image = null;
                }

                $total[] = $data;

            }

            if ($result[0]->coupon_id != null || $result[0]->coupon_id == 0)
            {
                $coupondata = DB::table('coupans')->select('*')->where('coupan_id', $data->coupon_id)->first();
                $coupon = $coupondata;
            } else {
                $coupon = null;
            }

            if ($result) {
                return response()->json(
                    [
                        'status' => true,
                        'message' => 'Order Find Successfully',
                        'data' => $total,
                        'coupon' => $coupon,
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
