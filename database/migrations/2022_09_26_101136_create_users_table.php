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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->string('email', 200)->nullable();
            $table->string('phone', 200)->nullable();
            $table->string('image', 200)->nullable();
            $table->string('password');
            $table->string('intrest_id', 200)->nullable();
            $table->string('status')->comment('0:block,1:unblock');
            $table->string('country_code', 200)->nullable();
            $table->tinyInteger('login_type')->default(1)->comment('0:store, 1:customer,2:driver');
            $table->tinyInteger('push_notification')->default(0)->comment('0:enable 1:disable');
            $table->tinyInteger('is_active')->default(0)->comment('0:Active, 1:Inactive');
            $table->tinyInteger('mob_verify')->default(0)->comment('0:Unverify, 1:Verify');
            $table->string('fcm_token', 200)->nullable();
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
        Schema::dropIfExists('users');
    }
};
