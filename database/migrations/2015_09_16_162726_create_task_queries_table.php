<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskQueriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_queries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('query_code')->unique();
            $table->dateTime('reporting_Date');
            $table->integer('from_department');
            $table->integer('from_branch');
            $table->integer('to_department');
            $table->integer('to_branch');
            $table->integer('module');
            $table->integer('reported_by');
            $table->string('critical_level');
            $table->text('description');
            $table->string('reference_file');
            $table->string('status');
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
        Schema::drop('task_queries');
    }
}
