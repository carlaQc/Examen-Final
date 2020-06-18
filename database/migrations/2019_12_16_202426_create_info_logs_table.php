<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfoLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_logs', function (Blueprint $table) {
            $table->increments('log_id');
            $table->integer('user_id')->unsigned();
            $table->integer('reservation_id')->unsigned()->nullable();
            $table->string('name');
            $table->dateTime('date');
            $table->string('data')->nullable();
            $table->string('new_data')->nullable();
            $table->text('url');
            // valor nuevo y el valor antiguo/la tabla modificada/cuando se realizo el cambio
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('reservation_id')->references('reservation_id')->on('info_reservations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('info_logs');
    }
}
