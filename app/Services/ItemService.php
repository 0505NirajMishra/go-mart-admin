<?php

namespace App\Services;

use App\Models\Item;
use Illuminate\Support\Facades\DB;

class ItemService
{
     /**
     * Update the specified resource in storage.
     *
     * @param  array $data
     * @return Promocode
     */
    public static function create(array $data)
    {
        $data = Item::create($data);
        return $data;
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  Array $data - Updated Data
     * @param  Promocode $promocode
     * @return Promocode
     */
    public static function update(array $data, Item $item)
    {
        $data = $item->update($data);
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
        $data = Item::whereId($id)->update($data);
        return $data;
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Promocode
     * @return bool
     */

     public static function delete(Item $item)
    {
        $data = $item->delete();
        return $data;
    }

     /**
     * Get data for datatable from storage.
     *
     * @return Promocode with states, countries
     */
    public static function datatable()
    {
        $data = DB::table('items')->orderBy('created_at', 'desc')->paginate(10);
        return $data;
    }
}
