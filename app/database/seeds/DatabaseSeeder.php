<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		 $this->call('AccountDirectorTableSeeder');
		 $this->call('UnitRepsTableSeeder');
		 $this->call('SpadRepsTableSeeder');
		 $this->call('RepEmailsTableSeeder');
	}

}