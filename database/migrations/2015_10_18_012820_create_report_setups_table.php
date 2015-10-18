<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportSetupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_setups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('archive_path')->nullable();
            $table->string('current_path')->nullable();
            $table->string('monthly_path')->nullable();
            $table->string('custom_path')->nullable();
            $table->date('archive_start_date')->nullable();
            $table->date('archive_end_date')->nullable();
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
        Schema::drop('report_setups');
    }
}
