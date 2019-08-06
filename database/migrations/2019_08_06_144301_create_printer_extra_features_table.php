<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrinterExtraFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('printer_extra_feature', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('printer_id')->unsigned();
            $table->bigInteger('extra_feature_id')->unsigned();
            $table->unsignedTinyInteger('is_enabled')->default(1);
            $table->timestamps();
        });

        Schema::table('printer_extra_feature', function (Blueprint $table) {
            $table->foreign('printer_id')
                  ->references('id')
                  ->on('printers');
            $table->foreign('extra_feature_id')
                  ->references('id')
                  ->on('extra_features');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('printer_extra_feature');
    }
}
