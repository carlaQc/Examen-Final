<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfoFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_fields', function (Blueprint $table) {
            $table->increments('field_id');
            $table->integer('center_id')->unsigned();
            $table->integer('field_state_id')->unsigned()->default(1);

            $table->string('name_field');
            $table->integer('price');
            $table->string('photo')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();

            $table->foreign('center_id')->references('center_id')->on('info_centers');
            $table->foreign('field_state_id')->references('field_state_id')->on('info_field_states');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('info_fields');
    }
}
