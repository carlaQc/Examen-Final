<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfoScheduleDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_schedule_details', function (Blueprint $table) {
            $table->increments('schedule_detail_id');
            $table->integer('schedule_id')->unsigned();
            $table->integer('day');
            $table->integer('state_day')->default(1);

            $table->timestamps();
            $table->foreign('schedule_id')->references('schedule_id')->on('info_schedules');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('info_schedule_details');
    }
}
