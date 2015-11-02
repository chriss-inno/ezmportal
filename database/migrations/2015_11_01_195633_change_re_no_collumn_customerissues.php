<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeReNoCollumnCustomerissues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('customer_issues', function(Blueprint $table)
        {
            $table->renameColumn('re_no','issues_number')->nullable();
            $table->date('today_date')->nullable()->add();

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
