<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOldslugsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oldarticleslugs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('slug');
            $table->unsignedBigInteger('article_id');
            $table->timestamps();
        });
        Schema::table('oldarticleslugs', function (Blueprint $table) {
            $table->foreign('article_id')->references('id')->on('articles');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('oldarticleslugs');
    }
}
