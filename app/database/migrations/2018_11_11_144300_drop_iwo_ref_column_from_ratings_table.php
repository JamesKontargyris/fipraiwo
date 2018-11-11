<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropIwoRefColumnFromRatingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ratings', function($table)
        {
           $table->dropColumn('iwo_ref');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('iwo_ref', function($table)
        {
            $table->string('iwo_ref')->after('iwo_id');
        });
	}

}
