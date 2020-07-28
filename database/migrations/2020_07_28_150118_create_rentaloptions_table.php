<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentaloptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rentaloptions', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('full_operation_included')->default(1);
            $table->unsignedInteger('min_number_of_persons');
            $table->unsignedInteger('max_number_of_persons');
            $table->unsignedInteger('number_of_pages_included');
            $table->enum('rental_period_unit', ['M', 'Y', 'D', 'Q'])->default('M');
            $table->tinyInteger('color_technology');
            $table->tinyInteger('printing_included');
            $table->tinyInteger('copying_included');
            $table->tinyInteger('scanning_included');
            $table->text('description')->nullable()->default(null);
            $table->unsignedTinyInteger('is_enabled')->default(1);
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
        Schema::dropIfExists('rentaloptions');
    }
}
