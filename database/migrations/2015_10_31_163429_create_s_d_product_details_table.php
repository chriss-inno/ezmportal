<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSDProductDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_d_product_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('details_name');
            $table->string('description');
            $table->integer('product_details_id')->nullable();
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
        Schema::drop('s_d_product_details');
    }
}
