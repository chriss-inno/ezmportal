<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameReportPortalDepartment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('portal_reports', function (Blueprint $table) {
            $table->renameColumn('department_id','department')->nullable();
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
        Schema::table('portal_reports', function(Blueprint $table)
        {
            $table->renameColumn('department', 'department_id');
    });
    }
}
