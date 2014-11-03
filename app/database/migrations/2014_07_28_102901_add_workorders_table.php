<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWorkordersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('workorders', function($table)
        {
            $table->increments('id');
            $table->string('workorder');
            $table->boolean('confirmed')->default(0);
            $table->integer('formtype_id')->unsigned();
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
		Schema::drop('workorders');
	}

}
