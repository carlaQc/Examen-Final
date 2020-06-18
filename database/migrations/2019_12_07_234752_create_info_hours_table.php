<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfoHoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_hours', function (Blueprint $table) {
            $table->increments('hour_id');
            $table->integer('schedule_detail_id')->unsigned();
            $table->string('hour');
            $table->string('hour_secondary');
            $table->integer('state_hour')->default(1);
            $table->integer('number');

            $table->timestamps();
            $table->foreign('schedule_detail_id')->references('schedule_detail_id')->on('info_schedule_details');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('info_hours');
    }
}
