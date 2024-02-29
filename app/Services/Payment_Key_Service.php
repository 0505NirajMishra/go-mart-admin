<?php

namespace App\Services;

use App\Models\Payment_key_detail;
use Illuminate\Support\Facades\DB;

class Payment_Key_Service
{
     

     /**
     * Update the specified resource in storage.
     *
     * @param  Array $data - Updated Data
     * @param  Promocode $promocode
     * @return Promocode
     */
    
    public static function update(array $data, Payment_key_detail $payment_key_detail)
    {
        $data = $payment_key_detail->update($data);
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
        $data = Payment_key_detail::whereId($id)->update($data);
        return $data;
    }

}