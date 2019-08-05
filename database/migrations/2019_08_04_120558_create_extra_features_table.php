<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtraFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extra_features', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 250);
            $table->text('description')->default(null);
            $table->integer('position')->default(1);
            $table->tinyInteger('is_enabled')->default(1);
            $table->bigInteger('thumbnail_photo_id')->unsigned()->nullable()->default(null);
            $table->timestamps();
        });

        Schema::table('extra_features', function (Blueprint $table) {
            $table->foreign('thumbnail_photo_id')
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
        Schema::dropIfExists('extra_features');
    }
}
