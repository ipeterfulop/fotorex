<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrinterPapersizeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'printer_papersize',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->bigInteger('printer_id')->unsigned();
                $table->bigInteger('papersize_id')->unsigned();
                $table->timestamps();
            }
        );
        Schema::table(
            'printer_papersize',
            function (Blueprint $table) {
                $table->foreign('printer_id')
                      ->references('id')
                      ->on('printers');
                $table->foreign('papersize_id')
                      ->references('id')
                      ->on('papersizes');
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('printer_papersize');
    }
}
