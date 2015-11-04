<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemSetupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_setups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('credit_link_1')->nullable();
            $table->string('credit_link_2')->nullable();
            $table->string('hr_link_1')->nullable();
            $table->string('mm_link_1')->nullable();
            $table->datetime('query_exe_next_check')->nullable();
            $table->date('portal_eod_report_date')->nullable();
            $table->string('dailyquery_sent',2)->nullable();
            $table->dateTime('query_nextexe_check')->nullable();
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
        Schema::drop('system_setups');
    }
}
