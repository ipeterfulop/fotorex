<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAutoProcessToPrinterPhotoRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('printer_photo_roles', function (Blueprint $table) {
            $table->tinyInteger('auto_process')->unsigned();
        });
        \DB::table('printer_photo_roles')->insert([
            'id' => 1,
            'name' => 'original',
            'preferred_width' => 1,
            'preferred_height' => 1,
            'auto_process' => 0,
        ]);
        \DB::table('printer_photo_roles')->insert([
            'id' => 2,
            'name' => 'thumbnail',
            'preferred_width' => 64,
            'preferred_height' => 64,
            'auto_process' => 1,
        ]);
        \DB::table('printer_photo_roles')->insert([
            'id' => 3,
            'name' => 'index',
            'preferred_width' => 300,
            'preferred_height' => 300,
            'auto_process' => 1,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('printer_photo_roles', function (Blueprint $table) {
            //
        });
    }
}
