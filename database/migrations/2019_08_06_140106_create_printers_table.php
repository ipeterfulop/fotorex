<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrintersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('printers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('manufacturer_id')->unsigned();
            $table->text('name');
            $table->bigInteger('usergroup_size_id')->unsigned();
            $table->unsignedTinyInteger('color_technology');
            $table->unsignedTinyInteger('is_multifunctional')->default(1);
            $table->text('description');
            $table->text('slug');
            $table->string('html_page_title');
            $table->text('html_page_meta_description');
            $table->unsignedTinyInteger('printing_mode')->nullable()->defaut(null);
            $table->unsignedTinyInteger('copying_mode')->nullable()->defaut(null);
            $table->unsignedTinyInteger('scanning_mode')->nullable()->defaut(null);
            $table->unsignedTinyInteger('is_enabled')->default(1);
            $table->timestamps();
        });

        Schema::table('printers', function (Blueprint $table) {
            $table->foreign('manufacturer_id')
                  ->references('id')
                  ->on('manufacturers');
            $table->foreign('usergroup_size_id')
                ->references('id')
                ->on('usergroup_sizes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('printers');
    }
}
