<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProviderDocumentHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_document_history', function (Blueprint $table) {
            $table->bigIncrements('id')->index();
            $table->bigInteger('provider_document_id')->default(0)->index();
            $table->bigInteger('document_id')->default(0)->index();
            $table->bigInteger('document_status_id')->default(1)->index();
            $table->string('reason')->index()->nullable();
            $table->boolean('added_by')->default(0)->index();
            $table->boolean('updated_by')->default(0)->index();
            $table->boolean('deleted_by')->default(0)->index();
            $table->boolean('status')->default(1)->index();
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
        Schema::dropIfExists('provider_document_history');
    }
}
