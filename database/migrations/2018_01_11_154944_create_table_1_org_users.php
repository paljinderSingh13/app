<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTable1OrgUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opd_1_org_users',function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('type');
            $table->string('address');
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->string('phone');
            $table->string('email');
            $table->string('password');
            $table->integer('status');
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
        Schema::dropIfExists('1_org_users');
    }
}
