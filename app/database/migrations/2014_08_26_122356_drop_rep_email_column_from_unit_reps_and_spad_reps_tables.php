<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropRepEmailColumnFromUnitRepsAndSpadRepsTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('unit_reps', function($table)
        {
           $table->dropColumn('rep_email');
        });

        Schema::table('spad_reps', function($table)
        {
            $table->dropColumn('rep_email');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('unit_reps', function($table)
        {
            $table->string('rep_email');
        });

        Schema::table('spad_reps', function($table)
        {
            $table->string('rep_email');
        });
	}

}
