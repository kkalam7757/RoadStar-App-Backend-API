<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProviderMandatoryDocumentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_mandatory_document', function (Blueprint $table) {
            $table->bigIncrements('id')->index();
            $table->string('name')->index()->nullable();
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
        Schema::dropIfExists('provider_mandatory_document');
    }
}
