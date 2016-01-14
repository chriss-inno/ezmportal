<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReminderEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reminder_emails', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rmd_id');
            $table->string('email');
            $table->string('status');
            $table->string('input_by')->nullable();
            $table->string('auth_by')->nullable();
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
        Schema::drop('reminder_emails');
    }
}
