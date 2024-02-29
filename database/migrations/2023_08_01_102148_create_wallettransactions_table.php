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
        Schema::create('wallettransactions', function (Blueprint $table) {
            $table->increments('wallet_id');
            $table->string('name');
            $table->string('order_type');
            $table->string('order_status')->default(0)->comment('0:pending,1:complete,2:cancel');
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
        Schema::dropIfExists('wallettransactions');
    }
};