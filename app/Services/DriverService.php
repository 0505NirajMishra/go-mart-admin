<?php

namespace App\Services;

use App\Models\Drivers;
use Illuminate\Support\Facades\DB;

class DriverService
{
     /**
     * Update the specified resource in storage.
     *
     * @param  array $data
     * @return Promocode
     */
    public static function create(array $data)
    {
        $data = Drivers::create($data);
        return $data;
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  Array $data - Updated Data
     * @param  Promocode $promocode
     * @return Promocode
     */
    public static function update(array $data, Drivers $driver)
    {
        $data = $driver->update($data);
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
        $data = Drivers::whereId($id)->update($data);
        return $data;
    }

    

     /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Promocode
     * @return bool
     */
    
     public static function delete(Drivers $driver)
    {
        $data = $driver->delete();
        return $data;
    }


     /**
     * Get data for datatable from storage.
     *
     * @return Promocode with states, countries
     */
    public static function datatable()
    {
        $data = DB::table('drivers')->orderBy('created_at', 'desc')->paginate(10);
        return $data;
    }
}