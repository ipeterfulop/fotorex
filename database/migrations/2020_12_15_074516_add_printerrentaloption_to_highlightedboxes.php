<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPrinterrentaloptionToHighlightedboxes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('highlightedboxes', function (Blueprint $table) {
            $table->unsignedBigInteger('printer_rentaloption_id')->nullable()->default(null);
        });
        Schema::table('highlightedboxes', function (Blueprint $table) {
            $table->foreign('printer_rentaloption_id')->references('id')->on('printer_rentaloption');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('highlightedboxes', function (Blueprint $table) {
            //
        });
    }
}
