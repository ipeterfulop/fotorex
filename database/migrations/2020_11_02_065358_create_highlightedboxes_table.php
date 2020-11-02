<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHighlightedboxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'highlightedboxes',
            function (Blueprint $table) {
                $table->id();
                $table->string('title', 100);
                $table->string('subtitle', 50);
                $table->foreignId('article_id')
                      ->nullable()
                      ->default(null)
                      ->constrained();
                $table->foreignId('printer_id')
                      ->nullable()
                      ->default(null)
                      ->constrained();
                $table->foreignId('photo_id')
                      ->nullable()
                      ->default(null)
                      ->constrained();
                $table->foreignId('custom_photo_id')
                      ->nullable()
                      ->default(null)
                      ->constrained('photos');
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
        Schema::dropIfExists('highlightedboxes');
    }
}
