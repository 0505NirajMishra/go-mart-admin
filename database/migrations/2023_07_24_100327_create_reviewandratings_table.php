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
        Schema::create('reviewandratings', function (Blueprint $table) {
            $table->increments('rating_id');
            $table->string('user_id')->nullable();
            $table->string('store_id')->nullable();
            $table->string('order_id')->nullable();
            $table->string('item_id')->nullable();
            $table->string('order_review')->nullable();
            $table->string('rating')->nullable();
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
        Schema::dropIfExists('reviewandratings');
    }

};
