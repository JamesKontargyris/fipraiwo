<?php

class RepEmailsTableSeeder extends DatabaseSeeder {
	public function run() {
		Eloquent::unguard();

		DB::table( 'rep_emails' )->delete();

		$email = [
			'Olga Bakardzhieva' => 'olga.bakardzhieva@fipra.com',
			'Laura Batchelor'   => 'laura.batchelor@fipra.com',
			'Neil Causey'       => 'neil.causey@fipra.com',
			'Rory Chisholm'     => 'rory.chisholm@fipra.com',
			'Dirk Hudig'        => 'dirk.hudig@fipra.com',
			'Hilary Hudson'     => 'hilary.hudson@fipra.com',
			'Robert Madelin'    => 'robert.madelin@fipra.com',
			'Abigail Rowan'     => 'abigail.rowan@fipra.com',
		];

		foreach ( $email as $name => $address ) {
			Rep_email::create(
				[
					'rep_name'  => $name,
					'rep_email' => $address,
				]
			);
		}
	}
}