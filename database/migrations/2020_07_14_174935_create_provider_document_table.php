<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProviderDocumentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_document', function (Blueprint $table) {
            $table->bigIncrements('id')->index();
            $table->bigInteger('provider_id')->default(0)->index();
            $table->bigInteger('document_id')->default(0)->index();
            $table->string('document_image_name')->index()->nullable();
            $table->string('document_image_path')->index()->nullable();
            $table->boolean('document_status_id')->default(1)->index();
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
        Schema::dropIfExists('provider_document');
    }
}
