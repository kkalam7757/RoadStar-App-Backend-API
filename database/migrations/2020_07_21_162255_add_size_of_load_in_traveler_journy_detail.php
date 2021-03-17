<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSizeOfLoadInTravelerJournyDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('individual_journy_detail', function (Blueprint $table) {
           $table->string('size_of_load')->index()->after('journy_medium')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('individual_journy_detail', function (Blueprint $table) {
            $table->dropColumn(['size_of_load']);
        });
    }
}
