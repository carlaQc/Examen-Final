<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');           
            $table->integer('rol_id')->unsigned()->default(4); 
            $table->integer('center_id')->unsigned()->nullable();
            
            $table->string('name',45);
            $table->string('paternal',45)->nullable();
            $table->string('maternal',45)->nullable();
            $table->string('gender',45)->nullable();
            $table->string('address',50)->nullable();
            $table->string('email',45)->unique();
            $table->string('ci',45)->unique()->nullable();
            $table->integer('day')->nullable();
            $table->integer('month')->nullable();
            $table->integer('year')->nullable();

            $table->integer('attempts')->default(0);
            $table->dateTime('date_attempts')->nullable();

            $table->integer('state')->default(1);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('phone',15)->nullable();
            $table->string('photo')->default('default.png')->nullable();
            $table->timestamps();

            $table->foreign('rol_id')->references('rol_id')->on('info_rols');
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
        Schema::dropIfExists('users');
    }
}
