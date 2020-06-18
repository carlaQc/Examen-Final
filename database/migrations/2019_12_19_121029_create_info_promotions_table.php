<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfoPromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_promotions', function (Blueprint $table) {
            $table->increments('promotion_id');
            $table->integer('center_id')->unsigned();
            $table->string('description_promotion');
            $table->dateTime('date');
            $table->integer('state')->default(1);
            $table->timestamps();

            $table->foreign('center_id')->references('center_id')->on('info_centers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('info_promotions');
    }
}
