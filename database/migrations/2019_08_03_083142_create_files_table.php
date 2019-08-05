<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('original_filename', 250)->nullable()->default(null);
            $table->string('filename', 250);
            $table->text('path_to');
            $table->bigInteger('original_file_id')->unsigned()->nullable()->default(null);
            $table->timestamps();
        });
        Schema::table('files', function (Blueprint $table) {
            $table->foreign('original_file_id')
                  ->references('id')
                  ->on('files');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}
