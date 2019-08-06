<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrinterTechnicalSpecificationCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('printer_technical_specification_category', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('printer_id')->unsigned();
            $table->bigInteger('technical_specification_category_id')->unsigned();
            $table->text('html_content');
            $table->unsignedTinyInteger('is_enabled')->default(1);
            $table->timestamps();
        });

        Schema::table('printer_technical_specification_category', function (Blueprint $table) {
            $table->foreign('printer_id', 'FK_01_printer_technical_specification_category')
                  ->references('id')
                  ->on('printers');
            $table->foreign('technical_specification_category_id', 'FK_02_printer_technical_specification_category')
                  ->references('id')
                  ->on('technical_specification_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('printer_technical_specification_category');
    }
}
