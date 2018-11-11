<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('ratings', function($table)
        {
            $table->increments('id');
	        $table->integer('iwo_id')->unsigned();
	        $table->string('iwo_ref');
	        $table->integer('user_id')->unsigned();
	        $table->integer('score');
	        $table->string('comment');
            $table->timestamps();

            $table->foreign('iwo_id')->references('id')->on('workorders');
            $table->foreign('user_id')->references('id')->on('users');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ratings');
	}

}
