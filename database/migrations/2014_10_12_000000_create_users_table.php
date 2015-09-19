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
            $table->string('user_type')->default('normal');
            $table->string('auth_by');
            $table->string('input_by');
            $table->integer('branch_id');
            $table->integer('department_id');
            $table->dateTime('last_login')->nullable();
            $table->dateTime('last_success_login')->nullable();
            $table->dateTime('last_logout')->nullable();
            $table->dateTime('last_failed_login')->nullable();
            $table->integer('login_attempt')->nullable();
            $table->integer('locked');
            $table->integer('block');
            $table->string('on_leave',3)->default('No');
            $table->dateTime('leave_stat_date')->nullable();
            $table->dateTime('leave_end_date')->nullable();
            $table->string('profile_image')->nullable();
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
