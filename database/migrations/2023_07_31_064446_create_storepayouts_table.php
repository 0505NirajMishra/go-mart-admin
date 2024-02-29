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
        Schema::create('storepayouts', function (Blueprint $table) {
            $table->increments('store_id');
            $table->string('store_name');
            $table->string('amount');
            $table->string('note');
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
        Schema::dropIfExists('storepayouts');
    }
};
