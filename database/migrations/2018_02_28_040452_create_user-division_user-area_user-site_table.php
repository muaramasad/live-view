<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDivisionUserAreaUserSiteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_division', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('division_id');

            $table->foreign('division_id')->references('id')->on('divisions')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')
            ->onUpdate('cascade')->onDelete('cascade');

            $table->unique(['user_id', 'division_id']);
            $table->timestamps();
        });

        Schema::create('user_area', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('area_id');

            $table->foreign('area_id')->references('id')->on('areas')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')
            ->onUpdate('cascade')->onDelete('cascade');

            $table->unique(['user_id', 'area_id']);
            $table->timestamps();
        });

        Schema::create('user_site', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('site_id');

            $table->foreign('site_id')->references('id')->on('sites')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')
            ->onUpdate('cascade')->onDelete('cascade');

            $table->unique(['user_id', 'site_id']);
            $table->timestamps();
        });

        // Schema::create('user_area', function (Blueprint $table) {
        //     $table->unsignedInteger('user_id');
        //     $table->unsignedInteger('area_id');
        //     $table->foreign('area_id')->references('id')->on('areas')->onUpdate('area_id')->onDelete('cascade');
        //     $table->unique(['user_id', 'area_id']);
        //     $table->timestamps();
        // });

        // Schema::create('user_site', function (Blueprint $table) {
        //     $table->unsignedInteger('user_id');
        //     $table->unsignedInteger('site_id');
        //     $table->foreign('site_id')->references('id')->on('sites')->onUpdate('site_id')->onDelete('cascade');
        //     $table->unique(['user_id', 'site_id']);
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_division');
        Schema::dropIfExists('user_area');
        Schema::dropIfExists('user_site');
    }
}
