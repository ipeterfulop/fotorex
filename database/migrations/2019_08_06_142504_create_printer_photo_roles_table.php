<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrinterPhotoRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('printer_photo_roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('preferred_width')->nullable()->default(null);
            $table->integer('preferred_height')->nullable()->default(null);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('printer_photo_roles');
    }
}
