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
        Schema::create('globals', function (Blueprint $table) 
        {
            $table->increments('global_id');
            $table->string('application_name');
            $table->string('application_logo');
            $table->string('application_color');
            $table->string('currency_symbol');
            $table->string('currency_code');
            $table->string('currency_name');
            $table->string('address');
            $table->string('phone');
            $table->string('email');
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
        Schema::dropIfExists('globals');
    }
};