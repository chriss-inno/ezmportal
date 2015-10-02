<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ip_address')->nullable();
            $table->string('type_id')->nullable();
            $table->string('item_name')->nullable();
            $table->string('user_name')->nullable();
            $table->string('machine_model')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('usb')->nullable();
            $table->string('antivirus')->nullable();
            $table->string('description')->nullable();
            $table->integer('department_id')->nullable();
            $table->integer('branch_id')->nullable();
            $table->string('status')->nullable();
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
        Schema::drop('inventories');
    }
}
