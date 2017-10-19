<?php

class SpadRepsTableSeeder extends DatabaseSeeder {
	public function run() {
		Eloquent::unguard();

		DB::table( 'spad_reps' )->delete();

		$spad_reps = [
			'Lorenzo Allio'         => 'Dirk Hudig',
			'Peter Chase'           => 'Dirk Hudig',
			'Stephanie Ayres'       => 'Rory Chisholm',
			'John B. Richardson'    => 'Hilary Hudson',
			'Catherine Bent'        => 'Peter-Carlo Lehrell',
			'John Bowis'            => 'Laura Batchelor',
			'Carol Brosgart'        => 'Laura Batchelor',
			'Raman Chadha'          => 'Peter-Carlo Lehrell',
			'Michael D’Arcy'        => 'Mark Fielding',
			'Willem de Ruiter'      => 'Hilary Hudson',
			'Achilleas Demetriades' => 'Laura Batchelor',
			'Humbert Drabbe'        => 'Dirk Hudig',
			'Hans de Belder'        => 'Peter-Carlo Lehrell',
			'Rory Faber'            => 'Peter-Carlo Lehrell',
			'Antonio Fournier'      => 'Mark Fielding',
			'Stein Jacob Frisch'    => 'Peter-Carlo Lehrell',
			'Carles Gasòliba'       => 'Peter-Carlo Lehrell',
			'Michael Goldinger'     => 'Peter-Carlo Lehrell',
			'John Gore'             => 'Dirk Hudig',
			'Joe Huggard'           => 'Dirk Hudig',
			'Russ Keene'            => 'Mark Fielding',
			'David McDonald Joyce'  => 'Peter-Carlo Lehrell',
			'Alp Mehmet'            => 'Peter-Carlo Lehrell',
			'Bernard Merkel'        => 'Laura Batchelor',
			'Vladimir Metelsky'     => 'Peter-Carlo Lehrell',
			'Nicola Montorsi'       => 'Peter-Carlo Lehrell',
			'Abdullah Nassief'      => 'Mark Fielding',
			'Jenni Newman'          => 'Peter-Carlo Lehrell',
			'Danut Nicolae'         => 'Rory Chisholm',
			'Una O Dwyer'           => 'Mark Fielding',
			'Juan Prat y Coll'      => 'Peter-Carlo Lehrell',
			'Shan Ramburuth'        => 'Peter-Carlo Lehrell',
			'Julius Sen'            => 'Peter-Carlo Lehrell',
			'Sabine Seeger'         => 'Dirk Hudig',
			'Greg Shea'             => 'Peter-Carlo Lehrell',
			'Alexander Shelemekh'   => 'Peter-Carlo Lehrell',
			'Peter Tulkens'         => 'Laura Batchelor',
			'John Tzoannos'         => 'Hilary Hudson',
			'Anton Van der Lande'   => 'Dirk Hudig',
			'Paul Vandoren'         => 'Dirk Hudig',
			'Richard Wainwright'    => 'Rory Chisholm',
			'Rob Walton'            => 'Laura Batchelor',
			'Mikhail Yurlov'        => 'Peter-Carlo Lehrell',
			'Gianluca Comin'        => 'Dirk Hudig',
			'Krzysztof Lisek'       => 'Peter-Carlo Lehrell',
			'Wolfgang Schneider'    => 'Dirk Hudig',
			'Nathalie Hesketh'      => 'Hilary Hudson',
			'Martin Cauchi Inglott' => 'Hilary Hudson',
			'Matthew Snoding'       => 'Hilary Hudson',
			'Andrea Parola'         => 'Hilary Hudson',
			'JB Renard'             => 'Dirk Hudig',
			'Sir Kent Woods'        => 'Laura Batchelor',
			'James Wilson'          => 'Peter-Carlo Lehrell',
			'Karl Milner'           => 'Rory Chisholm',
			'Phil Evans'            => 'Rory Chisholm',
			'Martin Territt'            => 'Peter-Carlo Lehrell',
			'Georg Serentschy'            => 'Hilary Hudson',
			'Karen Strandgaard'            => 'Robert Madelin',
			'Simone Ceruti'            => 'Robert Madelin',
			'Avril Doyle'            => 'Laura Batchelor',
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