<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForexDealSlipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forex_deal_slips', function (Blueprint $table) {
            $table->increments('id');
            $table->string('deal_number');
            $table->dateTime('deal_date');
            $table->date('value_date');
            $table->integer('counter_party');
            $table->string('curr_amount_bought');
            $table->string('rate');
            $table->string('curr_amount_sold');
            $table->string('confirmed_with');
            $table->string('bankm_dealer');
            $table->string('mobile');
            $table->dateTime('confirmed_date');
            $table->string('instruction');
            $table->string('email');
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
        Schema::drop('forex_deal_slips');
    }
}
