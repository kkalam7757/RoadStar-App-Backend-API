<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddParticalDetailInTravelerJournyDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('individual_journy_detail', function (Blueprint $table) {
           $table->string('practical_detail')->index()->after('size_of_load')->nullable();
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
            $table->dropColumn(['practical_detail']);
        });
    }
}
