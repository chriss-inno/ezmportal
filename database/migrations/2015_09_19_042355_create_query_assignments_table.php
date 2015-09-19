<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQueryAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('query_assignments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('query_id');
            $table->integer('user_id');
            $table->dateTime('assigned_date');
            $table->integer('assigned_by')->nullable();
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
        Schema::drop('query_assignments');
    }
}
