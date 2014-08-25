<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfirmationCodesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('confirmation_codes', function($table)
        {
            $table->increments('id');
            $table->integer('iwo_id');
            $table->string('code');

            $table->foreign('iwo_id')->references('id')->on('workorders')->onDelete('cascade');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('confirmation_codes');
	}

}
