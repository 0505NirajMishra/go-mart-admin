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
        Schema::create('items', function (Blueprint $table) {
            $table->increments('item_id');
            $table->string('category_id')->nullable();
            $table->string('store_id')->nullable();
            $table->string('item_name');
            $table->string('item_price');
            $table->string('item_publish');
            $table->string('organic_image')->nullable();
            $table->integer('quantity');
            $table->string('dis_item_price')->default(0);
            $table->string('item_image');
            $table->string('item_weight');
            $table->string('item_expiry_date');
            $table->string('item_description');
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
        Schema::dropIfExists('items');
    }
};
