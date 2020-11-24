<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeRentalColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rentaloptions', function (Blueprint $table) {
            $table->dropColumn('number_of_pages_included');
            $table->unsignedInteger('number_of_pages_included_bw');
            $table->unsignedInteger('number_of_pages_included_color');
        });
        Schema::table('printer_rentaloption', function (Blueprint $table) {
            $table->dropColumn('extra_page_price');
            $table->double('extra_page_price_bw', 4, 2);
            $table->double('extra_page_price_color', 4, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rentaloptions', function (Blueprint $table) {
            //
        });
    }
}
