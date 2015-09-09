<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_rights', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('module')->default(0);
            $table->integer('viw')->default(0);
            $table->integer('edi')->default(0);
            $table->integer('del')->default(0);
            $table->integer('inp')->default(0);
            $table->integer('aut')->default(0);
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
        Schema::drop('user_rights');
    }
}
