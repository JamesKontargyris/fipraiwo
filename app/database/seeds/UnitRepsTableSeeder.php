<?php


class UnitRepsTableSeeder extends DatabaseSeeder {
	public function run() {
		Eloquent::unguard();

		DB::table( 'unit_reps' )->delete();

		$unit_reps = [
			'FIPRA Australia'               => 'Hilary Hudson',
			'FIPRA Azerbaijan'              => 'Hilary Hudson',
			'FIPRA Brazil'                  => '',
			'FIPRA Bulgaria'                => 'Rory Chisholm',
			'FIPRA Canada'                  => '',
			'FIPRA China'                   => 'Rory Chisholm',
			'FIPRA Croatia'                 => 'Rory Chisholm',
			'FIPRA Cyprus (New Unit)'       => 'Laura Batchelor',
			'FIPRA Czech Republic'          => 'Rory Chisholm',
			'FIPRA Denmark'                 => '',
			'FIPRA Estonia'                 => '',
			'FIPRA Finland'                 => '',
			'FIPRA France'                  => 'Laura Batchelor',
			'FIPRA Germany (New Unit)'      => '',
			'FIPRA Greece'                  => 'Hilary Hudson',
			'FIPRA Hungary'                 => 'Rory Chisholm',
			'FIPRA India'                   => 'Robert Madelin',
			'FIPRA Ireland'                 => 'Rory Chisholm',
			'FIPRA Italy'                   => 'Laura Batchelor',
			'FIPRA Japan'                   => 'Hilary Hudson',
			'FIPRA Latvia'                  => '',
			'FIPRA Lithuania'               => '',
			'FIPRA Netherlands'             => 'Laura Batchelor',
			'FIPRA Norway'                  => '',
			'FIPRA Poland'                  => 'Rory Chisholm',
			'FIPRA Portugal'                => 'Laura Batchelor',
			'FIPRA Singapore'               => 'Hilary Hudson',
			'FIPRA Slovakia'                => 'Laura Batchelor',
			'FIPRA Slovenia'                => 'Rory Chisholm',
			'FIPRA South Africa (New Unit)' => '',
			'FIPRA South Korea'             => '',
			'FIPRA Spain'                   => 'Robert Madelin',
			'FIPRA Sweden'                  => '',
			'FIPRA Switzerland'             => 'Rory Chisholm',
			'FIPRA Turkey'                  => '',
			'FIPRA United Kingdom'          => 'Rory Chisholm',
			'FIPRA Uruguay (New Unit)'      => 'Laura Batchelor',
			'FIPRA Georgia (New Unit)'      => '',
			'FIPRA Austria (New Unit)'      => 'Laura Batchelor',
			'FIPRA Ukraine'                 => '',
			'FIPRA Morocco'                 => 'Rory Chisholm',
			'FIPRA Argentina'               => '',
			'FIPRA Romania'                 => 'Rory Chisholm',
			'FIPRA Russia'                  => '',
			'FIPRA Malta'                   => 'Hilary Hudson',
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