<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableAddForeignAreasAndSites extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sites', function (Blueprint $table) {
            $table->foreign('area_id')->references('id')->on('areas');
        });
        Schema::table('areas', function (Blueprint $table) {
            $table->foreign('division_id')->references('id')->on('divisions');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sites', function (Blueprint $table) {
            $table->dropForeign(['area_id']);
        });
        Schema::table('areas', function (Blueprint $table) {
            $table->dropForeign(['division_id']);
        });
    }
}
