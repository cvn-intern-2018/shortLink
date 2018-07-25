<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UrlInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('url_info', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->unsignedInteger('id_url');
            $table->timestamp('time_click');
            $table->string('browser', 20);
            $table->foreign('id_url')->references('id')->on('url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('url_info');
    }
}
