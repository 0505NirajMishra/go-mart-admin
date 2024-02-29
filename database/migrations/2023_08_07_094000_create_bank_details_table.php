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
        Schema::create('bank_details', function (Blueprint $table) {
            $table->increments('bank_id');
            $table->string('driver_id')->nullable();
            $table->string('store_id')->nullable();
            $table->string('bank_name');
            $table->string('branch_name');
            $table->string('holder_name');
            $table->string('account_number');
            $table->string('other_info');
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
        Schema::dropIfExists('bank_details');
    }
};
