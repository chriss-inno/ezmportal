<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToReminder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('reminders', function(Blueprint $table)
        {
            $table->string('notify_before')->nullable()->default('No')->add();
            $table->string('rm_access')->nullable()->add();
            $table->integer('user_id')->nullable()->add();
            $table->integer('send_status',3)->nullable()->default('No')->add();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
