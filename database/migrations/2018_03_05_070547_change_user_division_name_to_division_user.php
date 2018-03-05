<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeUserDivisionNameToDivisionUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('user_division', 'division_user');
        Schema::rename('user_area', 'area_user');
        Schema::rename('user_site', 'site_user');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('division_user', 'user_division');
        Schema::rename('area_user', 'user_area');
        Schema::rename('site_user', 'user_site');
    }
}
