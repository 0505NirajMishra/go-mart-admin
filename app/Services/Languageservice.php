<?php

namespace App\Services;

use App\Models\Language;
use Illuminate\Support\Facades\DB;

class Languageservice
{

     /**
     * Update the specified resource in storage.
     *
     * @param  array $data
     * @return Promocode
     */

    public static function create(array $data)
    {
        $data = Language::create($data);
        return $data;
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  Array $data - Updated Data
     * @param  Promocode $promocode
     * @return Promocode
     */
    public static function update(array $data, Language $language)
    {
        $data = $language->update($data);
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
        $data = Language::whereId($id)->update($data);
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
        $data = Language::find($id);
        return $data;
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Promocode
     * @return bool
     */
    
     public static function delete(Language $language)
    {
        $data = $language->delete();
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
        $data = Language::whereId($id)->delete();
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
        $data = Language::where('language_id', $id)->update($data);
        return $data;
    }

     /**
     * Get data for datatable from storage.
     *
     * @return Promocode with states, countries
     */
    public static function datatable()
    {
        $data = DB::table('languages')->orderBy('created_at', 'desc')->paginate(10);
        return $data;
    }
}