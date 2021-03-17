<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProviderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->bigIncrements('id')->index();
            $table->bigInteger('provider_type_id')->default(0)->index();
            $table->string('provider_unique_id')->index()->nullable();
            $table->string('name')->index()->nullable();
            $table->string('mobile')->index()->nullable();
            $table->string('email')->index()->nullable();
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
            $table->boolean('status')->default(false)->index();
            $table->text('description')->nullable();
            $table->softDeletes();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('providers');
    }
}
