<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDisplaynameColumnsToPrinters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'printers',
            function (Blueprint $table) {
                $table->string('model_number', 250)->after('name')->unique();
                $table->text('model_number_displayed')->nullable()->default(null);
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
            'printers',
            function (Blueprint $table) {
                //
            }
        );
    }
}
