<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManufacturersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manufacturers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);
            $table->integer('position')->default(1);
            $table->tinyInteger('is_enabled')->default(1);
            $table->text('url')->nullable()->default(null);
            $table->bigInteger('logo_photo_id')->unsigned()->nullable()->default(null);
            $table->timestamps();
        });

        Schema::table('manufacturers', function (Blueprint $table) {
            $table->foreign('logo_photo_id')
                  ->references('id')
                  ->on('photos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manufacturers');
    }
}
