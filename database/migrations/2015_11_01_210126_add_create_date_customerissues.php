<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCreateDateCustomerissues extends Migration
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
            $table->date('date_created')->nullable()->add();

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
        Schema::table('customer_issues', function(Blueprint $table)
        {
            $table->date('date_created')->nullable()->drop();

        });
    }
}
