<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProviderVehicleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_vehicle', function (Blueprint $table) {
            $table->bigIncrements('id')->index();
            $table->bigInteger('provider_id')->index()->default(0);
            $table->bigInteger('service_id')->index()->default(0);
            $table->bigInteger('service_medium_id')->index()->default(0);
            $table->string('vehicle_company_name')->index()->nullable();
            $table->string('vehicle_image')->index()->nullable();
            $table->string('vehicle_number')->index()->nullable();
            $table->text('description')->nullable();
            $table->boolean('status')->default(1)->index();
            $table->bigInteger('added_by')->default(0)->index();
            $table->bigInteger('updated_by')->default(0)->index();
            $table->bigInteger('deleted_by')->default(0)->index();
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
        Schema::dropIfExists('provider_vehicle');
    }
}
