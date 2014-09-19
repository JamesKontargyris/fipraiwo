<?php


class UnitLeadContactTableSeeder extends DatabaseSeeder {
	public function run() {

		Eloquent::unguard();

		DB::table( 'unit_lead_contacts' )->delete();

		$unit_lead_contacts = [
			'Fipra Australia'      => 'John Richardson',
			'Fipra Belarus'        => 'Vladimir Metelsky',
			'Fipra Brazil'         => 'José Gabriel Assis de Almeida',
			'Fipra Bulgaria'       => 'Rositsa Velkova',
			'Fipra Canada'         => 'Andre Albinati',
			'Fipra China'          => 'Haiying Yuan',
			'Fipra Columbia'       => 'Adriana Mejia',
			'Fipra Croatia'        => 'Natko Vlahovic',
			'Fipra Czech Republic' => 'Jana Marco',
			'Fipra Denmark'        => 'Lars Abel',
			'Fipra Estonia'        => 'Andreas Kaju',
			'Fipra Finland'        => 'Ilari Marzano',
			'Fipra France'         => 'Jean Francois Guichard',
			'Fipra Germany'        => 'Angelika Josten-Janssen',
			'Fipra Hungary'        => 'Tamás Sárdi',
			'Fipra India'          => 'Raman Chadha',
			'Fipra International'  => 'Peter-Carlo Lehrell',
			'Fipra Ireland'        => 'Ann Kelly',
			'Fipra Italy'          => 'Mariella Palazzolo',
			'Fipra Japan'          => 'Philip Howard',
			'Fipra South Korea'    => 'Yun-Hee Lee',
			'Fipra Latvia'         => 'Armands Gutmanis',
			'Fipra Lithuania'      => 'Arūnas Pemkus',
			'Fipra Malta'          => 'Ukko Metsola',
			'Fipra Netherlands'    => 'Miriam Offermans',
			'Fipra Norway'         => 'Per Høiby',
			'Fipra Poland'         => 'Marek Matraszek',
			'Fipra Portugal'       => 'Ana Vila Nova',
			'Fipra Romania'        => 'Danut Nicolai',
			'Fipra Russia'         => 'Alex Andreev',
			'Fipra Slovakia'       => 'Patrik Zoltvany',
			'Fipra Slovenia'       => 'Michael Cigler',
			'Fipra South Africa'   => 'Jenni Newman',
			'Fipra Spain'          => 'Sebastian Mariz',
			'Fipra Sweden'         => 'Bo Krogvig',
			'Fipra Switzerland'    => 'Dominique Reber',
			'Fipra Turkey'         => 'Ayse Aricioglu',
			'Fipra Ukraine'        => 'James Wilson',
			'Fipra United Kingdom' => 'Rory Chisholm',
		];

		$lead_contact_emails = [
			'John Richardson'               => 'john.richardson@fipra.com',
			'Vladimir Metelsky'             => 'vladimir.metelsky@fipra.com',
			'José Gabriel Assis de Almeida' => 'jose.almeida@fipra.com',
			'Rositsa Velkova'               => 'rositsa.velkova@fipra.com',
			'Andre Albinati'                => 'andre.albinati@fipra.com',
			'Haiying Yuan'                  => 'haiying.yuan@fipra.com',
			'Adriana Mejia'                 => 'adriana.mejia@fipra.com',
			'Natko Vlahovic'                => 'natko.vlahovic@fipra.com',
			'Jana Marco'                    => 'jana.marco@fipra.com',
			'Lars Abel'                     => 'lars.abel@fipra.com',
			'Andreas Kaju'                  => 'andreas.kaju@fipra.com',
			'Ilari Marzano'                 => 'ilari.marzano@fipra.com',
			'Jean Francois Guichard'        => 'jeanfrancois.guichard@fipra.com',
			'Angelika Josten-Janssen'       => 'angelika.jostenjanssen@fipra.com',
			'Tamás Sárdi'                   => 'tamas.sardi@fipra.com',
			'Raman Chadha'                  => 'raman.chadha@fipra.com',
			'Peter-Carlo Lehrell'           => 'lehrell@fipra.com',
			'Ann Kelly'                     => 'ann.kelly@fipra.com',
			'Mariella Palazzolo'            => 'mariella.palazzolo@fipra.com',
			'Philip Howard'                 => 'philip.howard@fipra.com',
			'Yun-Hee Lee'                   => 'yunhee.lee@fipra.com',
			'Armands Gutmanis'              => 'armands.gutmanis@fipra.com',
			'Arūnas Pemkus'                 => 'arunas.pemkus@fipra.com',
			'Ukko Metsola'                  => 'ukko.metsola@fipra.com',
			'Miriam Offermans'              => 'miriam.offermans@fipra.com',
			'Per Høiby'                     => 'per.hoiby@fipra.com',
			'Marek Matraszek'               => 'marek.matraszek@fipra.com',
			'Ana Vila Nova'                 => 'ana.vilanova@fipra.com',
			'Danut Nicolai'                 => 'danut.nicolai@fipra.com',
			'Alex Andreev'                  => 'alex.andreev@fipra.com',
			'Patrik Zoltvany'               => 'patrik.zoltvany@fipra.com',
			'Michael Cigler'                => 'michael.cigler@fipra.com',
			'Jenni Newman'                  => 'jenni.newman@fipra.com',
			'Sebastian Mariz'               => 'sebastian.mariz@fipra.com',
			'Bo Krogvig'                    => 'bo.krogvig@fipra.com',
			'Dominique Reber'               => 'dominique.reber@fipra.com',
			'Ayse Aricioglu'                => 'ayse.aricioglu@fipra.com',
			'James Wilson'                  => 'james.wilson@fipra.com',
			'Rory Chisholm'                 => 'rory.chisholm@fipra.com',
		];

		foreach ( $unit_lead_contacts as $unit => $contact ) {
			Unit_lead_contact::create( [
				'unit_name'         => $unit,
				'lead_contact_name' => $contact,
				'email'             => $lead_contact_emails[$contact],
			]);
		}
	}
} 