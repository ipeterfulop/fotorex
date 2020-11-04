<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOriginalUrlToFiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'files',
            function (Blueprint $table) {
                $table->text('original_url')
                      ->nullable()
                      ->default(null)
                      ->after('original_filename');
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
            'files',
            function (Blueprint $table) {
            }
        );
    }
}
