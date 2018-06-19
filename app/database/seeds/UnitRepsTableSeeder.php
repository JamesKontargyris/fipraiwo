<?php


class UnitRepsTableSeeder extends DatabaseSeeder {
	public function run() {
		Eloquent::unguard();

		DB::table( 'unit_reps' )->delete();

		$unit_reps = [
			'Fipra Australia'               => 'Hilary Hudson',
			'Fipra Azerbaijan'              => 'Hilary Hudson',
			'Fipra Brazil'                  => 'David Lawsky',
			'Fipra Bulgaria'                => 'Rory Chisholm',
			'Fipra Canada'                  => 'David Lawsky',
			'Fipra China'                   => 'Rory Chisholm',
			'Fipra Croatia'                 => 'Rory Chisholm',
			'Fipra Cyprus (New Unit)'       => 'Laura Batchelor',
			'Fipra Czech Republic'          => 'Rory Chisholm',
			'Fipra Denmark'                 => 'Kaisu Karvala',
			'Fipra Estonia'                 => 'Kaisu Karvala',
			'Fipra Finland'                 => 'Kaisu Karvala',
			'Fipra France'                  => 'Laura Batchelor',
			'Fipra Germany (New Unit)'      => 'Willem Vriesendorp',
			'Fipra Greece'                  => 'Hilary Hudson',
			'Fipra Hungary'                 => 'Rory Chisholm',
			'Fipra India'                   => 'Robert Madelin',
			'Fipra Ireland'                 => 'Rory Chisholm',
			'Fipra Italy'                   => 'Laura Batchelor',
			'Fipra Japan'                   => 'Hilary Hudson',
			'Fipra Latvia'                  => 'Kaisu Karvala',
			'Fipra Lithuania'               => 'David Lawsky',
			'Fipra Netherlands'             => 'Laura Batchelor',
			'Fipra Norway'                  => 'Kaisu Karvala',
			'Fipra Poland'                  => 'Rory Chisholm',
			'Fipra Portugal'                => 'Laura Batchelor',
			'Fipra Singapore'               => 'Hilary Hudson',
			'Fipra Slovakia'                => 'Laura Batchelor',
			'Fipra Slovenia'                => 'Rory Chisholm',
			'Fipra South Africa (New Unit)' => 'Willem Vriesendorp',
			'Fipra South Korea'             => 'David Lawsky',
			'Fipra Spain'                   => 'Robert Madelin',
			'Fipra Sweden'                  => 'Kaisu Karvala',
			'Fipra Switzerland'             => 'Rory Chisholm',
			'Fipra Turkey'                  => 'Kaisu Karvala',
			'Fipra United Kingdom'          => 'Rory Chisholm',
			'Fipra Uruguay (New Unit)'      => 'Laura Batchelor',
			'Fipra Georgia (New Unit)'      => 'Kaisu Karvala',
			'Fipra Austria (New Unit)'      => 'Laura Batchelor',
			'Fipra Ukraine'                 => 'Kaisu Karvala',
			'Fipra UK'                      => 'Rory Chisholm',
			'Fipra Morocco'                 => 'Rory Chisholm',
			'Fipra Argentina'               => 'David Lawsky',
			'Fipra Romania'                 => 'Rory Chisholm',
			'Fipra Russia'                  => 'Kaisu Karvala',
		];

		foreach ( $unit_reps as $unit => $rep ) {
			Unit_rep::create(
				[
					'fipra_unit' => $unit,
					'rep'        => $rep,
				]
			);
		}
	}
} 