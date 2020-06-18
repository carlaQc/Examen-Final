<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfoCentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_centers', function (Blueprint $table) {
            $table->increments('center_id');
            $table->string('name_center');
            $table->string('nit')->nullable();
            $table->string('address')->nullable();
            $table->string('activity')->nullable();
            $table->string('cellphone')->nullable();
            $table->string('photo')->default('center.png');
            $table->integer('state')->default(1);
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
        Schema::dropIfExists('info_centers');
    }
}
