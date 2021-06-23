<?php


class AccountDirectorTableSeeder extends DatabaseSeeder {
	public function run() {
		Eloquent::unguard();

		DB::table( 'account_directors' )->delete();

		$account_directors = [
			'Daniel Furby'          => 'daniel.furby@fipra.com',
			'Dirk Hudig'            => 'dirk.hudig@fipra.com',
			'Hilary Hudson'         => 'hilary.hudson@fipra.com',
			'Dayanthi Adeyemo'      => 'dayanthi.adeyemo@fipra.com',
			'Laura Batchelor'       => 'laura.batchelor@fipra.com',
			'Olivera Drazic'        => 'olivera.drazic@fipra.com',
			'Rory Chisholm'         => 'rory.chisholm@fipra.com',
			'Neil Causey'           => 'neil.causey@fipra.com',
			'Robert Madelin'        => 'robert.madelin@fipra.com',
			'Katharina Ossenberg'   => 'katharina.ossenberg@fipra.com',
			'Dorothée Coucharrière' => 'dorothee.coucharriere@fipra.com',
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