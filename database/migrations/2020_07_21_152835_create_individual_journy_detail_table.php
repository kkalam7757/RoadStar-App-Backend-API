<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndividualJournyDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('individual_journy_detail', function (Blueprint $table) {
            $table->bigIncrements('id')->index();
            $table->bigInteger('provider_id')->index()->default(0);
            $table->date('departure_date')->index()->nullable();
            $table->date('arrival_date')->index()->nullable();
            $table->date('return_departure_date')->index()->nullable();
            $table->date('return_arrival_date')->index()->nullable();
            $table->string('departure_from')->index()->nullable();
            $table->string('arrival_to')->index()->nullable();
            $table->string('journy_medium')->index()->nullable();
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
        Schema::dropIfExists('individual_journy_detail');
    }
}
