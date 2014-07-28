<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLeadContactsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lead_contacts', function($table)
        {
            $table->increments('id');
            $table->string('iwo_id')->unique();
            $table->string('email');

            $table->foreign('iwo_id')->references('id')->on('workorders');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('lead_contacts');
	}

}
