<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropLeadContactsAndSubContactsTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::drop('lead_contacts');
		Schema::drop('sub_contacts');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::create('lead_contacts', function($table)
        {
            $table->increments('id');
            $table->string('iwo_id')->unique();
            $table->string('email');

            $table->foreign('iwo_id')->references('id')->on('workorders');
        });

        Schema::create('sub_contacts', function($table)
        {
            $table->increments('id');
            $table->string('iwo_id')->unique();
            $table->string('email');

            $table->foreign('iwo_id')->references('id')->on('workorders');
        });
	}

}
