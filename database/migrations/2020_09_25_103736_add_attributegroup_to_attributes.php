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
                      ->constrained();
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
