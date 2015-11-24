<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSMSLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_m_s_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('phone');
            $table->string('message');
            $table->string('status');
            $table->integer('message_id');
            $table->date('dispatch_date');
            $table->dateTime('dispatch_date_tm');
            $table->string('input_by');
            $table->string('auth_by');
            $table->string('auth_status',1)->default('U');
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
        Schema::drop('s_m_s_logs');
    }
}
