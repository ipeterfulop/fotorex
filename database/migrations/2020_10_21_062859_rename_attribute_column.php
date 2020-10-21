<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameAttributeColumn extends Migration
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
                if (Schema::hasColumn('attributes', 'use_at_product_comparison')) {
                    $table->renameColumn('use_at_product_comparison', 'position_at_product_comparison');
                }
            }
        );
        Schema::table(
            'attributes',
            function (Blueprint $table) {
                $table->smallInteger('position_at_product_comparison')
                      ->nullable()
                      ->default(null)
                      ->change();
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
