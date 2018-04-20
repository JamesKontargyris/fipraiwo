<?php


class UnitRepsTableSeeder extends DatabaseSeeder {
	public function run() {
		Eloquent::unguard();

		DB::table( 'unit_reps' )->delete();

		$unit_reps = [
			'Fipra Australia'                    => 'Hilary Hudson',
			'Fipra Azerbaijan'                   => 'Hilary Hudson',
			'Fipra Brazil'                       => 'Mark Fielding',
			'Fipra Bulgaria'                     => 'Rory Chisholm',
			'Fipra Canada'                       => 'Laura Batchelor',
			'Fipra China'                        => 'Mark Fielding',
			'Fipra Croatia'                      => 'Rory Chisholm',
			'Fipra Cyprus (Correspondent)'       => 'Laura Batchelor',
			'Fipra Czech Republic'               => 'Rory Chisholm',
			'Fipra Denmark'                      => 'Kaisu Karvala',
			'Fipra Estonia'                      => 'Kaisu Karvala',
			'Fipra Finland'                      => 'Kaisu Karvala',
			'Fipra France'                       => 'Laura Batchelor',
			'Fipra Germany'                      => 'Laura Batchelor',
			'Fipra Greece (Correspondent)'       => 'Hilary Hudson',
			'Fipra Hungary'                      => 'Rory Chisholm',
			'Fipra India'                        => 'Mark Fielding',
			'Fipra Ireland'                      => 'Rory Chisholm',
			'Fipra Italy'                        => 'Laura Batchelor',
			'Fipra Japan'                        => 'Hilary Hudson',
			'Fipra Latvia'                       => 'Laura Batchelor',
			'Fipra Lithuania'                    => 'Hilary Hudson',
			'Fipra Netherlands'                  => 'Laura Batchelor',
			'Fipra Norway'                       => 'Kaisu Karvala',
			'Fipra Poland'                       => 'Rory Chisholm',
			'Fipra Portugal'                     => 'Laura Batchelor',
			'Fipra Singapore'                    => 'Hilary Hudson',
			'Fipra Slovakia'                     => 'Laura Batchelor',
			'Fipra Slovenia'                     => 'Willem Vriesendorp',
			'Fipra South Africa (Correspondent)' => 'Willem Vriesendorp',
			'Fipra South Korea'                  => 'Mark Fielding',
			'Fipra Spain'                        => 'Laura Batchelor',
			'Fipra Sweden'                       => 'Kaisu Karvala',
			'Fipra Switzerland'                  => 'Rory Chisholm',
			'Fipra Turkey'                       => 'Mark Fielding',
			'Fipra United Kingdom'               => 'Rory Chisholm',
			'Fipra Uruguay (Correspondent)'      => 'Laura Batchelor',
			'Fipra Georgia (Correspondent)'      => 'Mark Fielding',
			'Fipra Austria (Correspondent)'      => 'Kaisu Karvala',
			'Fipra Ukraine'                      => 'Mark Fielding',
			'Fipra UK'                           => 'Rory Chisholm',
			'Fipra Morocco'                      => 'Rory Chisholm',
			'Fipra Argentina'                    => 'Mark Fielding',
			'Fipra Romania'                    => 'Rory Chisholm',
			'Fipra Russia'                    => 'Mark Fielding',
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