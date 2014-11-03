<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailrecipientsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('emailrecipients', function($table)
		{
			$table->increments('id');
			$table->string('email');
			$table->string('name');
			$table->integer('formtype_id');
			$table->timestamps();

			$table->foreign('formtype_id')->references('id')->on('formtypes');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('emailrecipients');
	}

}
