<?php

class SpadRepsTableSeeder extends DatabaseSeeder {
	public function run() {
		Eloquent::unguard();

		DB::table( 'spad_reps' )->delete();

		$spad_reps = [
			'Lorenzo Allio'         => 'Dirk Hudig',
			'Peter Chase'           => 'Dirk Hudig',
			'Stephanie Ayres'       => 'Rory Chisholm',
			'John B. Richardson'    => 'Dirk Hudig',
			'Catherine Bent'        => 'Mark Fielding',
			'John Bowis'            => 'Laura Batchelor',
			'Carol Brosgart'        => 'Laura Batchelor',
			'Raman Chadha'          => 'Peter-Carlo Lehrell',
			'Michael D’Arcy'        => 'Mark Fielding',
			'Willem de Ruiter'      => 'Hilary Hudson',
			'Achilleas Demetriades' => 'Laura Batchelor',
			'Humbert Drabbe'        => 'Dirk Hudig',
			'Jos Draijer'           => 'Laura Batchelor',
			'Hans de Belder'        => 'Mark Fielding',
			'Rory Faber'            => 'Rory Chisholm',
			'Antonio Fournier'      => 'Mark Fielding',
			'Stein Jacob Frisch'    => 'Peter-Carlo Lehrell',
			'Carles Gasòliba'       => 'Laura Batchelor',
			'Michael Goldinger'     => 'Peter-Carlo Lehrell',
			'John Gore'             => 'Dirk Hudig',
			'Stuart Harbinson'      => 'Dirk Hudig',
			'Joe Huggard'           => 'Dirk Hudig',
			'Russ Keene'            => 'Mark Fielding',
			'Stephen Labaton'       => 'Rory Chisholm',
			'John Maré'             => 'Peter-Carlo Lehrell',
			'David McDonald Joyce'  => 'Hilary Hudson',
			'Alp Mehmet'            => 'Peter-Carlo Lehrell',
			'Bernard Merkel'        => 'Laura Batchelor',
			'Vladimir Metelsky'     => 'Peter-Carlo Lehrell',
			'Nicola Montorsi'       => 'Peter-Carlo Lehrell',
			'Abdullah Nassief'      => 'Mark Fielding',
			'Jenni Newman'          => 'Peter-Carlo Lehrell',
			'Danut Nicolae'         => 'Rory Chisholm',
			'Una O Dwyer'           => 'Mark Fielding',
			'Juan Prat y Coll'      => 'Peter-Carlo Lehrell',
			'John Prideaux'         => 'Peter-Carlo Lehrell',
			'Shan Ramburuth'        => 'Peter-Carlo Lehrell',
			'Julius Sen'            => 'Mark Fielding',
			'Sabine Seeger'         => 'Dirk Hudig',
			'Greg Shea'             => 'Peter-Carlo Lehrell',
			'Alexander Shelemekh'   => 'Peter-Carlo Lehrell',
			'Peter Tulkens'         => 'Laura Batchelor',
			'John Tzoannos'         => 'Hilary Hudson',
			'Anton Van der Lande'   => 'Dirk Hudig',
			'Paul Vandoren'         => 'Dirk Hudig',
			'Richard Wainwright'    => 'Dirk Hudig',
			'Rob Walton'            => 'Laura Batchelor',
			'Mikhail Yurlov'        => 'Rory Chisholm',
			'Gianluca Comin'        => 'Dirk Hudig',
			'Krzysztof Lisek'       => 'Willem Vriesendorp',
			'Wolfgang Schneider'    => 'Dirk Hudig',
			'Nathalie Hesketh'      => 'Hilary Hudson',
			'Martin Cauchi Inglott' => 'Hilary Hudson',
			'Matthew Snoding'       => 'Hilary Hudson',
			'Andrea Parola'         => 'Hilary Hudson',
			'JB Renard'             => 'Dirk Hudig',
			'Sir Kent Woods'        => 'Laura Batchelor',
			'Claus Biermann'        => 'Laura Batchelor',
			'Johan van Calster'     => 'Laura Batchelor',
			'James Wilson'          => 'Dirk Hudig',
			'Jan Ahlskog'           => 'Dirk Hudig',
		];

		foreach ( $spad_reps as $spad => $rep ) {
			Spad_rep::create(
				[
					'spad' => $spad,
					'rep'  => $rep,
				]
			);
		}
	}
} 