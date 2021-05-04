<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdditionalInfoFieldToUnitLeadContactsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('unit_lead_contacts', function($table)
		{
			$table->string('additional_info');
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
			$table->dropColumn('additional_info');
		});
	}

}
