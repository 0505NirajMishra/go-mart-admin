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
        Schema::create('drivers', function (Blueprint $table) {
            $table->increments('driver_id');
            $table->string('driver_name');
            $table->string('driver_image');
            $table->string('store_name')->nullable();
            $table->string('driver_phone_number');
            $table->string('driver_email')->unique();
            $table->string('driver_address');
            $table->string('driver_longitude');
            $table->string('driver_latitude');
            $table->string('driver_status')->default(0)->comment('0:disable,1:enable');
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
        Schema::dropIfExists('drivers');
    }
};
