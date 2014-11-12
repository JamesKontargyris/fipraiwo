<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExpiryNotificationSentFieldToWorkordersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('workorders', function($table)
		{
			$table->boolean('expiry_notification_sent')->default(0)->unsigned()->after('cancelled');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('workorders', function($table)
		{
			$table->dropColumn('expiry_notification_sent');
		});
	}

}
