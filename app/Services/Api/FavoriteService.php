<?php

namespace App\Services\Api;

use App\Models\Fav;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FavoriteService
{

    public static function addFavorite(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'item_id' => 'required',
                'like_status' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation fails',
                    'error' => $validator->errors(),
                ], 400);
            }

            $datafav=Fav::where('user_id',auth()->user()->id)->where('item_id',$request->item_id)->first();

            if(!empty($datafav)){
                $Input = [
                    'like_status' => $request->like_status,
                ];
                $AddFav = Fav::where('user_id',auth()->user()->id)->where('item_id',$request->item_id)->update($Input);
            }else{
                $FavInput = [
                    'user_id' => auth()->user()->id,
                    'item_id' => $request->item_id,
                    'like_status' => $request->like_status,
                ];
                $AddFav = Fav::create($FavInput);
            }

            if ($AddFav) {
                return response()->json(
                    [
                        'status' => true,
                        'message' => 'Favorite add succesfully',
                    ],
                    200
                );
            } else {
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'Not Added',
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

    public static function getFavoriteList(Request $request)
    {
        $getFavoriteList = DB::table('items')
            ->select('items.*', 'favorites.*')
            ->join('favorites', 'favorites.item_id', '=', 'items.item_id')
            ->where(['favorites.user_id' => auth()->user()->id, 'favorites.like_status' => 1])->get();

        if (count($getFavoriteList) > 0) {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Successfully',
                    'data' => $getFavoriteList,
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

    public static function RemoveFavorite(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        $FavItem = DB::table('favorites')->where('id', $request->id)->delete();

        if ($FavItem) {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Deleted Successfully',
                    'data' => $FavItem,
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data Not Deleted',
                    'data' => [],
                ],
                200
            );
        }
    }

}
