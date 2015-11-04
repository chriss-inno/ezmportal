<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAuditOnsyssetup extends Migration
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
            $table->string('input_by')->nullable()->add();
            $table->string('auth_by')->nullable()->add();
            $table->string('auth_status',1)->default('U')->add();
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
