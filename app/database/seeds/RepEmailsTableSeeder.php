<?php

class RepEmailsTableSeeder extends DatabaseSeeder {
	public function run() {
		Eloquent::unguard();

		DB::table( 'rep_emails' )->delete();

		$email = [
			'Laura Batchelor'     => 'laura.batchelor@fipra.com',
			'Rory Chisholm'       => 'rory.chisholm@fipra.com',
			'Dirk Hudig'          => 'dirk.hudig@fipra.com',
			'Hilary Hudson'       => 'hilary.hudson@fipra.com',
			'David Lawsky'        => 'david.lawsky@fipra.com',
			'Peter-Carlo Lehrell' => 'lehrell@fipra.com',
			'Willem Vriesendorp'  => 'willem.vriesendorp@fipra.com',
			'Robert Madelin'      => 'robert.madelin@fipra.com',
			'Neil Causey'         => 'neil.causey@fipra.com',
			'Rachel Finnegan'     => 'rachel.finnegan@fipra.com',
			'Olga Bakardzhieva'   => 'olga.bakardzhieva@fipra.com',
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