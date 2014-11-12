<?php


class AccountDirectorsContactsTableSeeder extends DatabaseSeeder
{
	public function run()
	{
		Eloquent::unguard();

		DB::table( 'account_directors_contacts' )->delete();

		$account_directors_contacts = [
			['Laura Batchelor', 'mariehelene.chevallier@fipra.com'],
		];

		foreach ( $account_directors_contacts as $row )
		{
			Account_directors_contact::create( [
				'account_director_name'  => $row[0],
				'copy_email' => $row[1]
			] );
		}
	}
} 