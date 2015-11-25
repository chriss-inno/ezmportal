<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSDProgressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_d_progresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('issue_id');
            $table->string('issue_progress');
            $table->string('remarks');
            $table->date('progress_date');
            $table->dateTime('progress_date_tm');
            $table->integer('user_id');
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
        Schema::drop('s_d_progresses');
    }
}
