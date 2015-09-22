<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOracleSupportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oracle_supports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('issue_title');
            $table->string('description');
            $table->string('sr_number');
            $table->string('product');
            $table->string('contact');
            $table->dateTime('date_opened');
            $table->dateTime('date_closed')->nullable();
            $table->string('status');
            $table->string('input_by');
            $table->string('auth_by');
            $table->string('email_sent',1)->default('N');
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
        Schema::drop('oracle_supports');
    }
}
