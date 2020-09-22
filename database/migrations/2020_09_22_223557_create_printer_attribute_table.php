<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrinterAttributeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'printer_attribute',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->foreignId('printer_id')->constrained();
                $table->foreignId('attribute_id')->constrained();
                $table->foreignId('attribute_value_id')->nullable()->constrained();
                $table->string('customvalue', 255)->nullable()->default(null);
                $table->timestamps();
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
        Schema::dropIfExists('printer_attribute');
    }
}
