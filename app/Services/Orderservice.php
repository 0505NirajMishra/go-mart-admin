<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\DB;

class Orderservice
{
     /**
     * Update the specified resource in storage.
     *
     * @param  array $data
     * @return Promocode
     */
    public static function create(array $data)
    {
        $data = Order::create($data);
        return $data;
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  Array $data - Updated Data
     * @param  Promocode $promocode
     * @return Promocode
     */
    public static function update(array $data, Order $order)
    {
        $data = $order->update($data);
        return $data;
    }

     /**
     * UpdateById the specified resource in storage.
     *
     * @param  Array $data - Updated Data
     * @param  $id
     * @return Promocode
     */

    public static function updateById(array $data, $id)
    {
        $data = Order::whereId($id)->update($data);
        return $data;
    }

     /**
     * Get Data By Id from storage.
     *
     * @param  Int $id
     * @return Promocode
     */
    
     public static function getById($id)
    {
        $data = Order::find($id);
        return $data;
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Promocode
     * @return bool
     */
    
     public static function delete(Order $order)
    {
        $data = $order->delete();
        return $data;
    }

     /**
     * RemoveById the specified resource from storage.
     *
     * @param  $id
     * @return bool
     */
    
     public static function deleteById($id)
    {
        $data = Order::whereId($id)->delete();
        return $data;
    }

     /**
     * update data in storage.
     *
     * @param  Array $data - Updated Data
     * @param  Int $id - Promocode Id
     * @return bool
     */
    public static function status(array $data, $id)
    {
        $data = Order::where('order_id', $id)->update($data);
        return $data;
    }

     /**
     * Get data for datatable from storage.
     *
     * @return Promocode with states, countries
     */
    public static function datatable()
    {
        $data = DB::table('orders')->orderBy('created_at', 'desc')->paginate(10);
        return $data;
    }
}