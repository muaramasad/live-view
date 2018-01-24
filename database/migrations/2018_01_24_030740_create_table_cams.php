<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCams extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cam_name');
            $table->string('cam_ip_address')->nullable();;
            $table->string('cam_file_path')->nullable();;
            $table->string('cam_cor_x');
            $table->string('cam_cor_y');
            $table->integer('site_id')->unsigned()->index();
            $table->timestamps();

            $table->foreign('site_id')->references('id')->on('sites');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cams', function (Blueprint $table) {
            $table->dropForeign(['site_id']);
            $table->dropColumn(['site_id']);
        });
        Schema::dropIfExists('cams');
    }
}
