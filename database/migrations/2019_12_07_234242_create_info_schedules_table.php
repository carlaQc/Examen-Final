<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfoSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_schedules', function (Blueprint $table) {
            $table->increments('schedule_id');
            $table->integer('center_id')->unsigned();
            $table->integer('field_id')->unsigned();
            $table->integer('state')->default(1);

            $table->timestamps();
            $table->foreign('center_id')->references('center_id')->on('info_centers');
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
        Schema::dropIfExists('info_schedules');
    }
}
