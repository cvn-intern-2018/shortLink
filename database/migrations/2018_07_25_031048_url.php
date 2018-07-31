<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Url extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('url', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('url_original', 2048);
            $table->string('url_shorten', 20);
            $table->tinyInteger('short_type');
            $table->timestamp('created_at');
            $table->unique('url_shorten');

        });
        Schema::create('access', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned();
            $table->tinyInteger('browser');
            $table->text('clicked_time');
            $table->primary(['id', 'browser']);
            $table->foreign('id')->references('id')->on('url');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('url');
        Schema::dropIfExists('access');
    }
}
