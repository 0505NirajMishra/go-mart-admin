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
        Schema::create('useraddresss', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('order_id');
            $table->string('address');
            $table->string('zip');
            $table->string('city');
            $table->string('building');
            $table->string('address_type')->default(0)->comment('0:home,1:office,2:other');
            $table->string('other_address')->default(0)->comment('0:false,1:true');
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
        Schema::dropIfExists('useraddresss');
    }
};