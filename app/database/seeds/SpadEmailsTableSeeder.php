<?php

class SpadEmailsTableSeeder extends DatabaseSeeder {
	public function run() {
		Eloquent::unguard();

		DB::table( 'spad_emails' )->delete();

		$email = [
			'Lorenzo Allio'           => 'lorenzo.allio@fipra.com',
			'Stephanie Ayres'         => 'stephanie.ayres@fipra.com',
			'John B. Richardson'      => 'john.richardson@fipra.com',
			'Catherine Bent'          => 'catherine.bent@fipra.com',
			'John Bowis'              => 'john.bowis@fipra.com',
			'Carol Brosgart'          => 'carol.brosgart@fipra.com',
			'Raman Chadha'            => 'raman.chadha@fipra.com',
			'Michael D’Arcy'          => 'michael.d’arcy@fipra.com',
			'Willem de Ruiter'        => 'willem.deruiter@fipra.com',
			'Achilleas Demetriades'   => 'achilleas.demetriades@fipra.com',
			'Humbert Drabbe'          => 'humbert.drabbe@fipra.com',
			'Jos Draijer'             => 'jos.draijer@fipra.com',
			'Hans de Belder'          => 'hans.debelder@fipra.com',
			'Rory Faber'              => 'rory.faber@fipra.com',
			'Antonio Fournier'        => 'antonio.fournier@fipra.com',
			'Stein Jacob Frisch'      => 'steinjacob.frisch@fipra.com',
			'Carles Gasòliba'         => 'carles.gasòliba@fipra.com',
			'Michael Goldinger'       => 'michael.goldinger@fipra.com',
			'John Gore'               => 'john.gore@fipra.com',
			'Stuart Harbinson'        => 'stuart.harbinson@fipra.com',
			'Joe Huggard'             => 'joe.huggard@fipra.com',
			'Russ Keene'              => 'russ.keene@fipra.com',
			'Stephen Labaton'         => 'stephen.labaton@fipra.com',
			'John Maré'               => 'john.maré@fipra.com',
			'Alp Mehmet'              => 'alp.mehmet@fipra.com',
			'Bernard Merkel'          => 'bernard.merkel@fipra.com',
			'Vladimir Metelsky'       => 'vladimir.metelsky@fipra.com',
			'Nicola Montorsi'         => 'nicola.montorsi@fipra.com',
			'Abdullah Nassief'        => 'abdullah.nassief@fipra.com',
			'Jenni Newman'            => 'jenni.newman@fipra.com',
			'Danut Nicolae'           => 'danut.nicolae@fipra.com',
			'Una O Dwyer'             => 'una.odwyer@fipra.com',
			'Juan Prat y Coll'        => 'juan.pratcoll@fipra.com',
			'John Prideaux'           => 'john.prideaux@fipra.com',
			'Shan Ramburuth'          => 'shan.ramburuth@fipra.com',
			'Julius Sen'              => 'julius.sen@fipra.com',
			'Sabine Seeger'           => 'sabine.seeger@fipra.com',
			'Greg Shea'               => 'greg.shea@fipra.com',
			'Alexander Shelemekh'     => 'alexander.shelemekh@fipra.com',
			'Peter Tulkens'           => 'peter.tulkens@fipra.com',
			'John Tzoannos'           => 'john.tzoannos@fipra.com',
			'Anton Van der Lande'     => 'anton.vanderlande@fipra.com',
			'Paul Vandoren'           => 'paul.vandoren@fipra.com',
			'Richard Wainwright'      => 'richard.wainwright@fipra.com',
			'Rob Walton'              => 'rob.walton@fipra.com',
			'Mikhail Yurlov'          => 'mikhail.yurlov@fipra.com',
			'Gianluca Comin'          => 'gianluca.comin@fipra.com',
			'Krzysztof Lisek'         => 'krzysztof.lisek@fipra.com',
			'Wolfgang Schneider'      => 'wolfgang.schneider@fipra.com',
			'Nathalie Hesketh'        => 'nathalie.hesketh@fipra.com',
			'Martin Cauchi Inglott'   => 'martin.cauchiinglott@fipra.com',
			'Matthew Snoding'         => 'matthew.snoding@fipra.com',
			'Andrea Parola'           => 'andrea.parola@fipra.com',
			'JB Renard'               => 'jb.renard@fipra.com',
			'Sir Kent Woods'          => 'kent.woods@fipra.com',
			'Claus Biermann'          => 'claus.biermann@fipra.com',
			'Johan van Calster'       => 'johan.vancalster@fipra.com',
			'James Wilson'            => 'james.wilson@fipra.com',
			'Jan Ahlskog'             => 'jan.ahlskog@fipra.com',
			'Peter Chase'             => 'peter.chase@fipra.com',
			'Karl Milner'             => 'karl.milner@fipra.com',
			'Phil Evans'              => 'phil.evans@fipra.com',
			'Georg Serentschy'        => 'georg.serentschy@fipra.com',
			'Karen Strandgaard'       => 'karen.strandgaard@fipra.com',
			'Simone Ceruti'           => 'simone.ceruti@fipra.com',
			'Avril Doyle'             => 'avril.doyle@fipra.com',
			'Leena Kuusniemi'         => 'leena.kuusniemi@fipra.com',
			'Michele Bellavite'       => 'michele.bellavite@fipra.com',
			'Rutger Daems'            => 'rutger.daems@fipra.com',
			'Luisella Ciani'          => 'luisella.ciani@fipra.com',
			'Geert Dancet'            => 'geert.dancet@fipra.com',
			'Angelika Josten-Janssen' => 'angelika.jostenjanssen@fipra.com',
		];

		foreach ( $email as $name => $address ) {
			Spad_email::create(
				[
					'spad_name'  => $name,
					'spad_email' => $address,
				]
			);
		}
	}
}