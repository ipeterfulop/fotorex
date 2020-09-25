<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAttributegroupToAttributes extends Migration
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
                $table->foreignId('attributegroup_id')
                      ->nullable()
                      ->default(null)
                      ->constrained()
                      ->after('attribute_value_set_id');
                $table->tinyInteger('use_at_product_comparison')
                      ->unsigned()
                      ->default(0)
                      ->after('is_computed');
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
