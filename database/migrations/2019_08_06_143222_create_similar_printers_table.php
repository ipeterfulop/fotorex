<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSimilarPrintersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('similar_printers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('printer_id')->unsigned();
            $table->bigInteger('similar_printer_id')->unsigned();
            $table->integer('position')->default(1);
            $table->unsignedTinyInteger('is_enabled')->default(1);
            $table->timestamps();
        });
        Schema::table('similar_printers', function (Blueprint $table) {
            $table->foreign('printer_id')
                  ->references('id')
                  ->on('printers');
            $table->foreign('similar_printer_id')
                  ->references('id')
                  ->on('printers');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('similar_printers');
    }
}
