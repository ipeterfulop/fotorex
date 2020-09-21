<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToPrinters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('printers', function (Blueprint $table) {
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('printers', function (Blueprint $table) {
            $table->unsignedTinyInteger('fax_availability')->nullable()->default(null)->after('scanning_mode');
            $table->unsignedTinyInteger('network_availability')->nullable()->default(null)->after('scanning_mode');
            $table->unsignedTinyInteger('wifi_availability')->nullable()->default(null)->after('scanning_mode');
        });
    }
}
