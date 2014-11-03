<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSubContactsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('sub_contacts', function($table)
        {
            $table->increments('id');
            $table->integer('iwo_id')->unique();
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
		Schema::drop('sub_contacts');
	}

}
