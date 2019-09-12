<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomizedPrinterPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customized_printer_photos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('printer_photo_id')->unsigned();
            $table->bigInteger('printer_photo_role_id')->unsigned();
            $table->bigInteger('photo_id')->unsigned();
            $table->timestamps();
        });
        Schema::table('customized_printer_photos', function (Blueprint $table) {
            $table->foreign('printer_photo_id')
                ->references('id')
                ->on('printer_photo');
            $table->foreign('printer_photo_role_id')
                ->references('id')
                ->on('printer_photo_roles');
            $table->foreign('photo_id')
                ->references('id')
                ->on('photos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customized_printer_photos');
    }
}
