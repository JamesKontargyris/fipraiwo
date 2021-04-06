<?php

class SpadEmailsTableSeeder extends DatabaseSeeder {
	public function run() {
		Eloquent::unguard();

		DB::table( 'spad_emails' )->delete();

		$email = [
			'Lorenzo Allio'                 => 'lorenzo.allio@fipra.com',
			'Stephanie Ayres'               => 'stephanie.ayres@fipra.com',
			'Catherine Bent'                => 'catherine.bent@fipra.com',
			'John Bowis'                    => 'john.bowis@fipra.com',
			'Carol Brosgart'                => 'carol.brosgart@fipra.com',
			'Willem de Ruiter'              => 'willem.deruiter@fipra.com',
			'Humbert Drabbe'                => 'humbert.drabbe@fipra.com',
			'Bernard Merkel'                => 'bernard.merkel@fipra.com',
			'Una O Dwyer'                   => 'una.odwyer@fipra.com',
			'Juan Prat y Coll'              => 'juan.pratcoll@fipra.com',
			'Anton Van der Lande'           => 'anton.vanderlande@fipra.com',
			'Krzysztof Lisek'               => 'krzysztof.lisek@fipra.com',
			'Nathalie Hesketh'              => 'nathalie.hesketh@fipra.com',
			'Martin Cauchi Inglott'         => 'martin.cauchiinglott@fipra.com',
			'Matthew Snoding'               => 'matthew.snoding@fipra.com',
			'Andrea Parola'                 => 'andrea.parola@fipra.com',
			'JB Renard'                     => 'jb.renard@fipra.com',
			'Jan Ahlskog'                   => 'jan.ahlskog@fipra.com',
			'Peter Chase'                   => 'peter.chase@fipra.com',
			'Phil Evans'                    => 'phil.evans@fipra.com',
			'Georg Serentschy'              => 'georg.serentschy@fipra.com',
			'Karen Strandgaard'             => 'karen.strandgaard@fipra.com',
			'Avril Doyle'                   => 'avril.doyle@fipra.com',
			'Leena Kuusniemi'               => 'leena.kuusniemi@fipra.com',
			'Geert Dancet'                  => 'geert.dancet@fipra.com',
			'Matthieu Wemaere'              => 'matthieu.wemaere@fipra.com',
			'Krzysztof Szubert'             => 'krzysztof.szubert@fipra.com',
			'Peter-Carlo Lehrell'           => 'lehrell@fipra.com',
			'Andrea Mogni'                  => 'andrea.mogni@fipra.com',
			'Detlef Eckert'                 => 'detlef.eckert@fipra.com',
			'Dorothee Coucharriere'         => 'dorothee.coucharriere@fipra.com',
			'Alexandra Walmsley'            => 'alexandra.walmsley@fipra.com',
			'Bruno Alomar'                  => 'bruno.alomar@fipra.com',
			'David Lawsky'                  => 'david.lawsky@fipra.com',
			'Derk Oldenburg'                => 'derk.oldenburg@fipra.com',
			'Jens Karsten'                  => 'jens.karsten@fipra.com',
			'Sheela Upadhyaya'              => 'sheela.upadhyaya@fipra.com',
			'Stephanie Lvovich'             => 'stephanie.lvovich@fipra.com',
			'Maria Assimakopoulou-Sorensen' => 'maria.assimakopoulousorensen@fipra.com',
			'Helene Lloyd'                  => 'helene.lloyd@fipra.com',
			'Andrea Piha'                   => 'andrea.piha@fipra.com',
			'Philip Sinclair'               => 'philip.sinclair@fipra.com',
			'Dirk Hudig'                    => 'dirk.hudig@fipra.com',
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