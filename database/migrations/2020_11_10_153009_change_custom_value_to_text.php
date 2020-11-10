<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeCustomValueToText extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'printer_attribute',
            function (Blueprint $table) {
                $table->text('customvalue')
                      ->nullable()
                      ->default(null)
                      ->change();
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
        Schema::table(
            'printer_attribute',
            function (Blueprint $table) {
                //
            }
        );
    }
}
