<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToSystemsetupTable extends Migration
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
            $table->string('reminder_status')->nullable()->add();
            $table->dateTime('reminder_start_tm')->nullable()->add();
            $table->dateTime('reminder_end_tm')->nullable()->add();
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
    }
}
