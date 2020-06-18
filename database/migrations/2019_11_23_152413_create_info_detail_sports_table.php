<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfoDetailSportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_detail_sports', function (Blueprint $table) {
            $table->increments('detail_sport_id');
            $table->integer('field_id')->unsigned();
            $table->integer('sport_id')->unsigned();
            $table->string('observation')->nullable();
            $table->timestamps();

            $table->foreign('field_id')->references('field_id')->on('info_fields');
            $table->foreign('sport_id')->references('sport_id')->on('info_sports');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('info_detail_sports');
    }
}
