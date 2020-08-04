<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrinterRentaloptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('printer_rentaloption', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('printer_id');
            $table->unsignedBigInteger('rentaloption_id');
            $table->unsignedBigInteger('price')->nullable()->default(null);
            $table->double('extra_page_price', 4, 2);
            $table->text('extra_description')->nullable()->default(null);
            $table->unsignedTinyInteger('is_enabled')->default(1);
            $table->timestamps();
        });
        Schema::table('printer_rentaloption', function (Blueprint $table) {
            $table->foreign('printer_id')->references('id')->on('printers');
            $table->foreign('rentaloption_id')->references('id')->on('rentaloptions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('printer_rentaloption');
    }
}
