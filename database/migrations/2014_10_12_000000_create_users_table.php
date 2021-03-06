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
            $table->string('user_type')->default('normal');
            $table->integer('right_id')->default('1');
            $table->integer('branch_id');
            $table->integer('department_id');
            $table->integer('unit_id');
            $table->dateTime('last_login')->nullable();
            $table->dateTime('last_success_login')->nullable();
            $table->dateTime('last_logout')->nullable();
            $table->dateTime('last_failed_login')->nullable();
            $table->integer('login_attempt')->nullable();
            $table->integer('locked');
            $table->integer('block');
            $table->string('query_exemption',3)->default('No');
            $table->string('exemption_type')->nullable();
            $table->string('query_description')->nullable();
            $table->date('exemption_start_date')->nullable();
            $table->date('exemption_end_date')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('input_by');
            $table->string('auth_by');
            $table->string('status')->default('Inactive');
            $table->string('auth_status',1)->default('U');
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
