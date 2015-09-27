<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQueriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('queries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('query_code')->nullable();
            $table->dateTime('reporting_Date');
            $table->integer('from_department');
            $table->integer('from_branch');
            $table->integer('to_department');
            $table->integer('to_branch');
            $table->integer('module_id');
            $table->integer('reported_by');
            $table->string('critical_level');
            $table->text('description');
            $table->string('reference_file');
            $table->string('status');
            $table->string('current_stage');
            $table->integer('completed')->default('0');
            $table->integer('assigned')->default('0');
            $table->integer('closed')->default('0');
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
        Schema::drop('queries');
    }
}
