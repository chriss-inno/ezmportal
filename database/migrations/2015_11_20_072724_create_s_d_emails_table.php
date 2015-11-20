<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSDEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_d_emails', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('display_name')->nullable();
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
        Schema::drop('s_d_emails');
    }
}
