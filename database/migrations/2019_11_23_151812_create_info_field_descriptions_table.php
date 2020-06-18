<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfoFieldDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_field_descriptions', function (Blueprint $table) {
            $table->increments('field_description_id');
            $table->integer('field_id')->unsigned();

            $table->string('photo_description');
            $table->string('observation')->nullable();
            $table->timestamps();

            $table->foreign('field_id')->references('field_id')->on('info_fields');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('info_field_descriptions');
    }
}
