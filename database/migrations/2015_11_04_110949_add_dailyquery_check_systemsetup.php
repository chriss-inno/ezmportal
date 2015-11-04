<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDailyqueryCheckSystemsetup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('system_setups', function(Blueprint $table)
        {
            $table->string('dailyquery_sent',2)->nullable()->add();
            $table->dateTime('query_nextexe_check')->nullable()->add();
            $table->dateTime('automation_start_tm')->nullable()->add();
            $table->dateTime('automation_end_tm')->nullable()->add();
            $table->string('automation_status')->nullable()->add();

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
        Schema::table('system_setups', function(Blueprint $table)
        {
            $table->string('dailyquery_sent',2)->nullable()->drop();
            $table->dateTime('query_nextexe_check')->nullable()->drop();
        });
    }
}
