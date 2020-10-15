<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUrlToManufacturers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'manufacturers',
            function (Blueprint $table) {
                //
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
            'manufacturers',
            function (Blueprint $table) {
                $table->text('url_download_center')
                      ->nullable()
                      ->default(null)
                      ->after('url');
            }
        );
    }
}
