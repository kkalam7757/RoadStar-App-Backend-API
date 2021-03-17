<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name')->index()->nullable();
            $table->string('last_name')->index()->nullable();
            $table->string('mobile')->index()->nullable();
            $table->string('country_name')->index()->nullable();
            $table->string('country_code')->index()->nullable();
            $table->string('country_phone_code')->index()->nullable();
            $table->string('email')->index()->nullable();
            $table->string('profile_pic')->index()->nullable();
            $table->string('password')->index()->nullable();
            $table->string('token')->index()->nullable();
            $table->string('mobile_otp')->index()->nullable();
            $table->string('email_otp')->index()->nullable();
            $table->string('lat')->index()->nullable();
            $table->string('long')->index()->nullable();
            $table->bigInteger('country')->default(0)->index();
            $table->bigInteger('state')->default(0)->index();
            $table->bigInteger('city')->default(0)->index();
            $table->string('zip_code')->nullable()->index();
            $table->string('address')->index()->nullable();
            $table->boolean('is_registerd')->default(0)->index();
            $table->boolean('status')->default(1)->index();
            $table->longText('description')->nullable()->index();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
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
}
