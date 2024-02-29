<?php

namespace App\Services;

use App\Models\Subcategory;
use Illuminate\Support\Facades\DB;

class SubcategoryService
{
     /**
     * Update the specified resource in storage.
     *
     * @param  array $data
     * @return Promocode
     */
    public static function create(array $data)
    {
        $data = Subcategory::create($data);
        return $data;
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  Array $data - Updated Data
     * @param  Promocode $promocode
     * @return Promocode
     */
    public static function update(array $data, Subcategory $subcategory)
    {
        $data = $subcategory->update($data);
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
        $data = Subcategory::whereId($id)->update($data);
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
        $data = Subcategory::find($id);
        return $data;
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Promocode
     * @return bool
     */
    
     public static function delete(Subcategory $subcategory)
    {
        $data = $subcategory->delete();
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
        $data = Subcategory::whereId($id)->delete();
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
        $data = Subcategory::where('id', $id)->update($data);
        return $data;
    }

}