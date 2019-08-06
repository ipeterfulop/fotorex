<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrinterPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('printer_photo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('printer_id')->unsigned();
            $table->bigInteger('photo_id')->unsigned();
            $table->bigInteger('printer_photo_role_id')->unsigned();
            $table->unsignedTinyInteger('is_enabled')->default(1);
            $table->integer('position')->default(1);
            $table->timestamps();
        });

        Schema::table('printer_photo', function (Blueprint $table) {
            $table->foreign('printer_id')
                  ->references('id')
                  ->on('printers');
            $table->foreign('photo_id')
                  ->references('id')
                  ->on('photos');
            $table->foreign('printer_photo_role_id')
                  ->references('id')
                  ->on('printer_photo_roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('printer_photos');
    }
}
