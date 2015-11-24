<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSMSMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_m_s_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('message_title')->nullable();
            $table->text('message');
            $table->string('status');
            $table->dateTime('sent_time')->nullable();
            $table->date('sent_date')->nullable();
            $table->integer('dispatch_id');
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
        Schema::drop('s_m_s_messages');
    }
}
