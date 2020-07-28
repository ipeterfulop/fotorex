<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPriceRequestToPrinters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('printers', function (Blueprint $table) {
            $table->unsignedBigInteger('price')->nullable()->default(null);
            $table->tinyInteger('request_for_price')->default(0);
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
            //
        });
    }
}
