<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfoReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_reservations', function (Blueprint $table) {
            $table->increments('reservation_id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('admin_id')->unsigned()->nullable();
            $table->integer('center_id')->unsigned();
            $table->integer('field_id')->unsigned();
            $table->integer('reservation_state_id')->unsigned();
            $table->integer('state_payment_id')->default(1)->unsigned();

            $table->string('name_reservation');
            $table->dateTime('current_date'); //Fecha que reservo
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('day');
            $table->string('hour');
            $table->dateTime('date_expire')->nullable();
            $table->integer('payment')->default(0);
            $table->integer('pending_debt')->nullable();

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('admin_id')->references('id')->on('users');
            $table->foreign('center_id')->references('center_id')->on('info_centers');
            $table->foreign('field_id')->references('field_id')->on('info_fields');
            $table->foreign('reservation_state_id')->references('reservation_state_id')->on('info_reservation_states');
            $table->foreign('state_payment_id')->references('state_payment_id')->on('info_reservation_payment');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('info_reservations');
    }
}
