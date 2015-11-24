<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSMSDistributionListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_m_s_distribution_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('list_name');
            $table->string('descriptions');
            $table->string('status');
            $table->string('input_by');
            $table->string('auth_by');
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
        Schema::drop('s_m_s_distribution_lists');
    }
}
