<?php

class SpadRepsTableSeeder extends DatabaseSeeder {
	public function run() {
		Eloquent::unguard();

		DB::table( 'spad_reps' )->delete();

		$spad_reps = [
			'Lorenzo Allio'         => 'Robert Madelin',
			'Peter Chase'           => 'Robert Madelin',
			'Stephanie Ayres'       => 'Hilary Hudson',
			'John B. Richardson'    => 'Hilary Hudson',
			'Catherine Bent'        => 'Robert Madelin',
			'John Bowis'            => 'Laura Batchelor',
			'Carol Brosgart'        => 'Laura Batchelor',
			'Raman Chadha'          => 'Robert Madelin',
			'Michael D’Arcy'        => 'Olga Bakardzhieva',
			'Willem de Ruiter'      => 'Hilary Hudson',
			'Achilleas Demetriades' => 'Laura Batchelor',
			'Humbert Drabbe'        => 'Dirk Hudig',
			'Hans de Belder'        => 'Robert Madelin',
			'Rory Faber'            => 'Robert Madelin',
			'Antonio Fournier'      => 'Robert Madelin',
			'Stein Jacob Frisch'    => 'Robert Madelin',
			'Carles Gasòliba'       => 'Robert Madelin',
			'Michael Goldinger'     => 'Robert Madelin',
			'John Gore'             => 'Dirk Hudig',
			'Joe Huggard'           => 'Dirk Hudig',
			'Russ Keene'            => 'Mark Fielding',
			'David McDonald Joyce'  => 'Willem Vriesendorp',
			'Alp Mehmet'            => 'Robert Madelin',
			'Bernard Merkel'        => 'Laura Batchelor',
			'Vladimir Metelsky'     => 'Robert Madelin',
			'Nicola Montorsi'       => 'Robert Madelin',
			'Abdullah Nassief'      => 'Mark Fielding',
			'Jenni Newman'          => 'Robert Madelin',
			'Danut Nicolae'         => 'Rory Chisholm',
			'Una O Dwyer'           => 'Mark Fielding',
			'Juan Prat y Coll'      => 'Laura Batchelor',
			'Shan Ramburuth'        => 'Rory Chisholm',
			'Julius Sen'            => 'Robert Madelin',
			'Sabine Seeger'         => 'Dirk Hudig',
			'Greg Shea'             => 'Robert Madelin',
			'Alexander Shelemekh'   => 'Robert Madelin',
			'Peter Tulkens'         => 'Laura Batchelor',
			'John Tzoannos'         => 'Hilary Hudson',
			'Anton Van der Lande'   => 'Dirk Hudig',
			'Paul Vandoren'         => 'Robert Madelin',
			'Richard Wainwright'    => 'Rory Chisholm',
			'Rob Walton'            => 'Laura Batchelor',
			'Mikhail Yurlov'        => 'Peter-Carlo Lehrell',
			'Gianluca Comin'        => 'Dirk Hudig',
			'Krzysztof Lisek'       => 'Peter-Carlo Lehrell',
			'Wolfgang Schneider'    => 'Hilary Hudson',
			'Nathalie Hesketh'      => 'Hilary Hudson',
			'Martin Cauchi Inglott' => 'Hilary Hudson',
			'Matthew Snoding'       => 'Hilary Hudson',
			'Andrea Parola'         => 'Hilary Hudson',
			'JB Renard'             => 'Dirk Hudig',
			'Sir Kent Woods'        => 'Laura Batchelor',
			'James Wilson'          => 'Robert Madelin',
			'Karl Milner'           => 'Rory Chisholm',
			'Phil Evans'            => 'Rory Chisholm',
			'Martin Territt'        => 'Robert Madelin',
			'Georg Serentschy'      => 'Hilary Hudson',
			'Karen Strandgaard'     => 'Robert Madelin',
			'Simone Ceruti'         => 'Robert Madelin',
			'Avril Doyle'           => 'Laura Batchelor',
			'Leena Kuusniemi'       => 'Kaisu Karvala',
			'Michele Bellavite'     => 'Kaisu Karvala',
			'Rutger Daems'          => 'Laura Batchelor',
			'Luisella Ciani'        => 'Kaisu Karvala',
			'Geert Dancet'          => 'Laura Batchelor',
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