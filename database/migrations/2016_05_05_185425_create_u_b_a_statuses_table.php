<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUBAStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('u_b_a_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('score');
            $table->string('training');
            $table->string('attempt');
            $table->string('threshold');
            $table->string('date');
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
        Schema::drop('u_b_a_statuses');
    }
}
