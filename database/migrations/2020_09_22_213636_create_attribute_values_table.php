<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributeValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'attribute_values',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->foreignId('attribute_value_set_id')->constrained();
                $table->string('value', 255);
                $table->string('label', 255)->nullable()->default(null);
                $table->unsignedTinyInteger('is_enabled')->default(1);
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
        Schema::dropIfExists('attribute_values');
    }
}
