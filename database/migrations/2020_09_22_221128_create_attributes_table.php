<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'attributes',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name', 250);
                $table->string('label', 250)->nullable()->default(null);
                $table->foreignId('attribute_value_set_id')
                      ->nullable()
                      ->default(null)
                      ->constrained();
                $table->tinyInteger('is_computed')->unsigned()->default(0);
                $table->tinyInteger('is_enabled')->unsigned()->default(1);
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
        Schema::dropIfExists('attributes');
    }
}
