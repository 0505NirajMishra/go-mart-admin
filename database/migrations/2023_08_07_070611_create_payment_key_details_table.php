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
        Schema::create('payment_key_details', function (Blueprint $table) {
            $table->increments('payment_key_id');
            $table->string('razorpay_status')->comment('0:disable,1:enable')->default(0);
            $table->string('sandbox_mode_status')->comment('0:disable,1:enable')->default(0);
            $table->string('razorpay_key');
            $table->string('razorpay_secret');
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
        Schema::dropIfExists('payment_key_details');
    }
};