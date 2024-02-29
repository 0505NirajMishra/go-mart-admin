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
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_no')->nullable();
            $table->string('user_id')->nullable();
            $table->string('driver_id')->nullable();
            $table->string('store_id')->nullable();
            $table->string('order_date')->nullable();
            $table->string('order_time')->nullable();
            $table->string('address')->nullable();
            $table->string('order_amount');
            $table->string('payment_method');
            $table->string('coupon_id')->default(0)->nullable();
            $table->string('order_type')->default(0)->comment('0:cod.1:online');
            $table->string('order_status')->default(0)->comment('0:pending,1:processing,2:cancel,3:completed');
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
        Schema::dropIfExists('orders');
    }

};
