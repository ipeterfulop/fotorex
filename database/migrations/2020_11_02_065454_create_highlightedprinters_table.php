<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHighlightedprintersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'highlightedprinters',
            function (Blueprint $table) {
                $table->id();
                $table->foreignId('printer_id')
                      ->nullable()
                      ->default(null)
                      ->constrained();
                $table->unsignedTinyInteger('position')->default(1);
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
        Schema::dropIfExists('highlightedprinters');
    }
}
