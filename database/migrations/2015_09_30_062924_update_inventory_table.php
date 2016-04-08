<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateInventoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('inventories', function(Blueprint $table)
        {
            $table->string('machine_model')->nullable()->change();
            $table->string('serial_number')->nullable()->change();
            $table->string('platform')->nullable()->add();
            $table->string('domain')->nullable()->add();
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
