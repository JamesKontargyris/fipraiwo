<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRateBandFieldToUnitLeadContactsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('unit_lead_contacts', function($table)
		{
			$table->string('rate_band')->after('email');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('unit_lead_contacts', function($table)
		{
			$table->dropColumn('rate_band');
		});
	}

}
