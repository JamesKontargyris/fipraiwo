<?php


class UnitRepsTableSeeder extends DatabaseSeeder {
	public function run() {
		Eloquent::unguard();

		DB::table( 'unit_reps' )->delete();

		$unit_reps = [
			'Fipra Australia'                    => 'Hilary Hudson',
			'Fipra Azerbaijan'                   => 'Hilary Hudson',
			'Fipra Brazil'                       => 'Peter-Carlo Lehrell',
			'Fipra Bulgaria'                     => 'Rory Chisholm',
			'Fipra Canada'                       => 'David Lawsky',
			'Fipra China'                        => 'Mark Fielding',
			'Fipra Croatia'                      => 'Dirk Hudig',
			'Fipra Cyprus (Correspondent)'       => 'Laura Batchelor',
			'Fipra Czech Republic'               => 'Rory Chisholm',
			'Fipra Denmark'                      => 'Peter-Carlo Lehrell',
			'Fipra Estonia'                      => 'Peter-Carlo Lehrell',
			'Fipra Finland'                      => 'Peter-Carlo Lehrell',
			'Fipra France'                       => 'Laura Batchelor',
			'Fipra Germany'                      => 'Peter-Carlo Lehrell',
			'Fipra Greece (Correspondent)'       => 'Hilary Hudson',
			'Fipra Hungary'                      => 'Rory Chisholm',
			'Fipra India'                        => 'Mark Fielding',
			'Fipra Ireland'                      => 'Peter-Carlo Lehrell',
			'Fipra Italy'                        => 'Laura Batchelor',
			'Fipra Japan'                        => 'Mark Fielding',
			'Fipra Latvia'                       => 'Peter-Carlo Lehrell',
			'Fipra Lithuania'                    => 'Peter-Carlo Lehrell',
			'Fipra Netherlands'                  => 'Dirk Hudig',
			'Fipra Norway'                       => 'Peter-Carlo Lehrell',
			'Fipra Poland'                       => 'Rory Chisholm',
			'Fipra Portugal'                     => 'Laura Batchelor',
			'Fipra Singapore'                    => 'Mark Fielding',
			'Fipra Slovakia'                     => 'Laura Batchelor',
			'Fipra Slovenia'                     => 'Rory Chisholm',
			'Fipra South Africa (Correspondent)' => 'Mark Fielding',
			'Fipra South Korea'                  => 'Mark Fielding',
			'Fipra Spain'                        => 'Laura Batchelor',
			'Fipra Sweden'                       => 'Peter-Carlo Lehrell',
			'Fipra Switzerland'                  => 'Mark Fielding',
			'Fipra Turkey'                       => 'Mark Fielding',
			'Fipra United Kingdom'               => 'Rory Chisholm',
			'Fipra Uruguay (Correspondent)'      => 'Laura Batchelor',
			'Fipra Georgia (Correspondent)'      => 'Mark Fielding',
			'Fipra Austria (Correspondent)'      => 'Mark Fielding',
			'Fipra Ukraine'                      => 'Peter-Carlo Lehrell',
			'Fipra UK'                           => 'Rory Chisholm',
			'Fipra Morocco'                      => 'Peter-Carlo Lehrell',
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