<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIwoRefsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('iwo_refs', function($table)
        {
            $table->increments('id');
            $table->integer('iwo_id')->unsigned();
            $table->string('iwo_ref');
            $table->timestamps();

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
        Schema::drop('iwo_refs');
	}

}
