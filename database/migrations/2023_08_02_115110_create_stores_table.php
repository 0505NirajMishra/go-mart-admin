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
        Schema::create('stores', function (Blueprint $table) {
            $table->increments('store_id');
            $table->string('store_name');
            $table->string('category_name');
            $table->string('store_phone');
            $table->string('store_address');
            $table->string('store_image');
            $table->string('store_description');
            $table->string('store_latitude');
            $table->string('store_longitude');
            $table->string('store_opening_time');
            $table->string('store_closing_time');
            $table->string('store_status')->comment('0:close,1:open')->default(0);
            $table->string('store_active')->comment('0:enable,1:disable')->default(0);
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
        Schema::dropIfExists('stores');
    }
};
