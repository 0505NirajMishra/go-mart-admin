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
        Schema::create('item_addons', function (Blueprint $table) {
            $table->increments('addons_id');
            $table->string('item_id')->nullable();
            $table->string('addons_title')->nullable();
            $table->string('addons_price')->nullable();
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
        Schema::dropIfExists('item_addons');
    }
};
