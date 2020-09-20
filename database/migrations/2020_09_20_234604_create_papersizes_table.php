<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePapersizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('papersizes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('code', 3);
            $table->integer('width_in_millimetres')->unsigned();
            $table->integer('height_in_millimetres')->unsigned();
            $table->float('width_in_inches')->unsigned();
            $table->float('height_in_inches')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('papersizes');
    }
}
