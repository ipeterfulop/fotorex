<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductfamilyToAttributes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'attributes',
            function (Blueprint $table) {
                $table->tinyInteger('productfamily')
                      ->nullable()
                      ->default(null)
                      ->after('attribute_value_set_id');
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
        Schema::table(
            'attributes',
            function (Blueprint $table) {
                //
            }
        );
    }
}
