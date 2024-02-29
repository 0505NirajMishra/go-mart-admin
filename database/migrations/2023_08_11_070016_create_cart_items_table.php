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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('item_id');
            $table->string('item_name');
            $table->string('item_weight');
            $table->string('item_quantity');
            $table->string('item_price')->nullable();
            $table->string('item_description')->nullable();
            $table->string('dis_item_price')->default(0);
            $table->string('coupan_id')->default(0);
            $table->string('item_expiry_date')->nullable();
            $table->string('purchased_status')->default(1)->comment('1:unpurchase,0:purchase');
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
        Schema::dropIfExists('cart_items');
    }

};
