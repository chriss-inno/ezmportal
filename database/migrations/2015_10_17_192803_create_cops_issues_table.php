<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCopsIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cops_issues', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('input_date')->nullable();
            $table->string('reference_no')->nullable();
            $table->string('status')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('ac_no')->nullable();
            $table->string('iss_type')->nullable();
            $table->string('description')->nullable();
            $table->string('pendng_itm')->nullable();
            $table->date('dt_activated')->nullable();
            $table->string('rm_id')->nullable();
            $table->string('apprvdby')->nullable();
            $table->date('dt_rcvd')->nullable();
            $table->date('dt_promised')->nullable();
            $table->string('ref_reg')->nullable();
            $table->string('hbl')->nullable();
            $table->string('rmuser')->nullable();
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
        Schema::drop('cops_issues');
    }
}
