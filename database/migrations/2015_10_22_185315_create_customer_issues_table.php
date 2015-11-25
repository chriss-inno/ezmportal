<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_issues', function (Blueprint $table) {
            $table->increments('id');
            $table->string('re_no');
            $table->string('company_name');
            $table->string('contact_person')->nullable();
            $table->integer('product_id')->nullable();
            $table->integer('product_details_id')->nullable();
            $table->integer('mode_id')->nullable();
            $table->text('description')->nullable();
            $table->integer('department_id')->nullable();
            $table->string('received_by')->nullable();
            $table->integer('status_id')->nullable();
            $table->dateTime('date_resolved')->nullable();
            $table->string('remarks')->nullable();
            $table->string('closed',3)->default('No');
            $table->string('input_by')->nullable();
            $table->string('auth_by')->nullable();
            $table->string('auth_status',1)->default('U');
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
        Schema::drop('customer_issues');
    }
}
