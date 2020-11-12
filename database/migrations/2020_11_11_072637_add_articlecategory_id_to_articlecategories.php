<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddArticlecategoryIdToArticlecategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('articlecategories', function (Blueprint $table) {
            $table->foreignId('articlecategory_id')->nullable()->references('id')->on('articlecategories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articlecategories', function (Blueprint $table) {
            //
        });
    }
}
