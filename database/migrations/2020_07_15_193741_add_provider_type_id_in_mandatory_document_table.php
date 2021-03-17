<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProviderTypeIdInMandatoryDocumentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('provider_mandatory_document', function (Blueprint $table) {
           $table->bigInteger('provider_type_id')->index()->after('id')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('provider_mandatory_document', function (Blueprint $table) {
            $table->dropColumn(['provider_type_id']);
        });
    }
}
