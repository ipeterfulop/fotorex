<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCustomUrlToSimilarPrinters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('similar_printers', function (Blueprint $table) {
            $table->bigInteger('similar_printer_id')->unsigned()->nullable()->default(null)->change();
            $table->string('label')->nullable()->default(null);
            $table->string('url')->nullable()->default(null);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('similar_printers', function (Blueprint $table) {
            //
        });
    }
}
