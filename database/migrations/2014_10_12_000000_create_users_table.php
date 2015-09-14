<?php

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
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('designation');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('username')->unique();
            $table->string('bmno')->nullable();
            $table->string('password', 100);
            $table->string('status');
            $table->string('auth_by');
            $table->string('input_by');
            $table->integer('branch_id');
            $table->integer('department_id');
            $table->dateTime('last_login');
            $table->dateTime('last_success_login');
            $table->dateTime('last_failed_login');
            $table->integer('login_attempt');
            $table->integer('locked');
            $table->integer('block');
            $table->string('profile_image');
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
