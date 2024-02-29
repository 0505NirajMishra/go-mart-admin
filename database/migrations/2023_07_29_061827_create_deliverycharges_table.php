<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliverycharges', function (Blueprint $table) {
            $table->increments('delivery_id');
            $table->string('delivery_charge_per_km');
            $table->string('minimum_delivery_charge');
            $table->string('minimum_delivery_charge_with_km');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deliverycharges');
    }
};
