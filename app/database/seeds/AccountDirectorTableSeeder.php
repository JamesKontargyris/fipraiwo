<?php


class AccountDirectorTableSeeder extends DatabaseSeeder {
	public function run() {
		Eloquent::unguard();

		DB::table( 'account_directors' )->delete();

		$account_directors = [
			'Daniel Furby'      => 'daniel.furby@fipra.com',
			'David Lawsky'      => 'david.lawsky@fipra.com',
			'Dirk Hudig'        => 'dirk.hudig@fipra.com',
			'Hilary Hudson'     => 'hilary.hudson@fipra.com',
			'Dayanthi Adeyemo'  => 'dayanthi.adeyemo@fipra.com',
			'John Lion'         => 'john.lion@fipra.com',
			'Laura Batchelor'   => 'laura.batchelor@fipra.com',
			'Olivera Drazic'    => 'olivera.drazic@fipra.com',
			'Rory Chisholm'     => 'rory.chisholm@fipra.com',
			'Neil Causey'       => 'neil.causey@fipra.com',
			'Rachel Finnegan'   => 'rachel.finnegan@fipra.com',
			'Olga Bakardzhieva' => 'olga.bakardzhieva@fipra.com',
			'Robert Madelin'    => 'robert.madelin@fipra.com',
		];

		foreach ( $account_directors as $name => $email ) {
			Account_director::create(
				[
					'name'  => $name,
					'email' => $email
				]
			);
		}
	}
} 