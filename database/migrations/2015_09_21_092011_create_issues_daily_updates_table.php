<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIssuesDailyUpdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issues_daily_updates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('issue_id');
            $table->text('current_update');
            $table->string('input_by');
            $table->string('display_name');
            $table->string('auth_by');
            $table->string('auth_status',1)->default('U');
            $table->date('current_date');
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
        Schema::drop('issues_daily_updates');
    }
}
