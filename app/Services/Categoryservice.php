<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Facades\DB;

class Categoryservice
{
     /**
     * Update the specified resource in storage.
     *
     * @param  array $data
     * @return Promocode
     */
    public static function create(array $data)
    {
        $data = Category::create($data);
        return $data;
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  Array $data - Updated Data
     * @param  Promocode $promocode
     * @return Promocode
     */
    public static function update(array $data, Category $category)
    {
        $data = $category->update($data);
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
        $data = Category::whereId($id)->update($data);
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
        $data = Category::find($id);
        return $data;
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Promocode
     * @return bool
     */
    
     public static function delete(Category $category)
    {
        $data = $category->delete();
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
        $data = Category::whereId($id)->delete();
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
        $data = Category::where('id', $id)->update($data);
        return $data;
    }

     /**
     * Get data for datatable from storage.
     *
     * @return Promocode with states, countries
     */
    public static function datatable()
    {
        $data = DB::table('categories')->orderBy('created_at', 'desc')->paginate(10);
        return $data;
    }
}