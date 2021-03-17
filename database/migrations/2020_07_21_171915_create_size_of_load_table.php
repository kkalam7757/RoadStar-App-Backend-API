<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSizeOfLoadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('size_of_load', function (Blueprint $table) {
            $table->bigIncrements('id')->index();
            $table->string('name')->index()->nullable();
            $table->string('min_weight')->index()->nullable();
            $table->string('max_weight')->index()->nullable();
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
        Schema::dropIfExists('size_of_load');
    }
}
