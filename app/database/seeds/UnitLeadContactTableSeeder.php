<?php


class UnitLeadContactTableSeeder extends DatabaseSeeder {
	public function run() {

		Eloquent::unguard();

		DB::table( 'unit_lead_contacts' )->delete();

		$unit_lead_contacts = [
			'Fipra Australia'                    => 'John Richardson',
			'Fipra Brazil'                       => 'José Gabriel Assis de Almeida',
			'Fipra Bulgaria'                     => 'Rositsa Velkova',
			'Fipra Canada'                       => 'Andre Albinati',
			'Fipra China'                        => 'Haiying Yuan',
			'Fipra Croatia'                      => 'Natko Vlahovic',
			'Fipra Cyprus (Correspondent)'       => 'Andreas Hadjikyriacos',
			'Fipra Czech Republic'               => 'Jana Marco',
			'Fipra Denmark'                      => 'Lars Abel',
			'Fipra Estonia'                      => 'Andreas Kaju',
			'Fipra Finland'                      => 'Ilari Marzano',
			'Fipra France'                       => 'Jean Francois Guichard',
			'Fipra Germany'                      => 'Angelika Josten-Janssen',
			'Fipra Greece (Correspondent)'       => 'Anthony Gortzis',
			'Fipra Hungary'                      => 'Tamás Sárdi',
			'Fipra India'                        => 'Manash Neog',
			'Fipra International'                => '',
			'Fipra Ireland'                      => 'Ann Kelly',
			'Fipra Italy'                        => 'Mariella Palazzolo',
			'Fipra Japan'                        => 'Philip Howard',
			'Fipra Latvia'                       => 'Armands Gutmanis',
			'Fipra Lithuania'                    => 'Arūnas Pemkus',
			'Fipra Netherlands'                  => 'Peter van Keulen',
			'Fipra Norway'                       => 'Per Høiby',
			'Fipra Poland'                       => 'Marek Matraszek',
			'Fipra Portugal'                     => 'Ana Vila Nova',
			'Fipra Singapore'                    => 'Richard Andrew',
			'Fipra Slovakia'                     => 'Patrik Zoltvany',
			'Fipra Slovenia'                     => 'Mihael Cigler',
			'Fipra South Africa (Correspondent)' => 'Abdul Waheed Patel',
			'Fipra South Korea'                  => 'Yun-Hee Lee',
			'Fipra Spain'                        => 'Sebastian Mariz',
			'Fipra Sweden'                       => 'Anders Rostin',
			'Fipra Switzerland'                  => 'Dominique Reber',
			'Fipra Turkey'                       => 'Ayse Aricioglu',
			'Fipra Uruguay (Correspondent)'      => 'Jose Luis Echevarria',
			'Fipra Georgia (Correspondent)'      => 'Lasha Gogiberidze'
		];

		$unit_rate_bands = [
			'Fipra Australia'                    => 'high',
			'Fipra Brazil'                       => 'standard',
			'Fipra Bulgaria'                     => 'standard',
			'Fipra Canada'                       => 'high',
			'Fipra China'                        => 'standard',
			'Fipra Croatia'                      => 'standard',
			'Fipra Cyprus (Correspondent)'       => 'standard',
			'Fipra Czech Republic'               => 'standard',
			'Fipra Denmark'                      => 'high',
			'Fipra Estonia'                      => 'standard',
			'Fipra Finland'                      => 'high',
			'Fipra France'                       => 'high',
			'Fipra Germany'                      => 'high',
			'Fipra Greece (Correspondent)'       => 'standard',
			'Fipra Hungary'                      => 'standard',
			'Fipra India'                        => 'standard',
			'Fipra International'                        => 'high',
			'Fipra Ireland'                      => 'high',
			'Fipra Italy'                        => 'high',
			'Fipra Japan'                        => 'high',
			'Fipra Latvia'                       => 'standard',
			'Fipra Lithuania'                    => 'standard',
			'Fipra Netherlands'                  => 'high',
			'Fipra Norway'                       => 'high',
			'Fipra Poland'                       => 'standard',
			'Fipra Portugal'                     => 'standard',
			'Fipra Singapore'                    => 'high',
			'Fipra Slovakia'                     => 'standard',
			'Fipra Slovenia'                     => 'standard',
			'Fipra South Africa (Correspondent)' => 'standard',
			'Fipra South Korea'                  => 'high',
			'Fipra Spain'                        => 'standard',
			'Fipra Sweden'                       => 'high',
			'Fipra Switzerland'                  => 'high',
			'Fipra Turkey'                       => 'standard',
			'Fipra Uruguay (Correspondent)'      => 'standard',
			'Fipra Georgia (Correspondent)'      => 'standard'
		];

		$lead_contact_emails = [
			'John Richardson'               => 'johnl.richardson@fipra.com',
			'José Gabriel Assis de Almeida' => 'jose.almeida@fipra.com',
			'Rositsa Velkova'               => 'rositsa.velkova@fipra.com',
			'Andre Albinati'                => 'andre.albinati@fipra.com',
			'Haiying Yuan'                  => 'haiying.yuan@fipra.com',
			'Natko Vlahovic'                => 'natko.vlahovic@fipra.com',
			'Andreas Hadjikyriacos'         => 'andreas.hadjikyriacos@fipra.com',
			'Jana Marco'                    => 'jana.marco@fipra.com',
			'Lars Abel'                     => 'lars.abel@fipra.com',
			'Andreas Kaju'                  => 'andreas.kaju@fipra.com',
			'Ilari Marzano'                 => 'ilari.marzano@fipra.com',
			'Jean Francois Guichard'        => 'jeanfrancois.guichard@fipra.com',
			'Angelika Josten-Janssen'       => 'angelika.jostenjanssen@fipra.com',
			'Anthony Gortzis'               => 'anthony.gortzis@fipra.com',
			'Tamás Sárdi'                   => 'tamas.sardi@fipra.com',
			'Manash Neog'                   => 'manash.neog@fipra.com',
			'Peter-Carlo Lehrell'           => 'mark.fielding@fipra.com',
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
			'Alex Andreev'                  => 'alex.andreev@fipra.com',
			'Patrik Zoltvany'               => 'patrik.zoltvany@fipra.com',
			'Mihael Cigler'                 => 'mihael.cigler@fipra.com',
			'Sebastian Mariz'               => 'sebastian.mariz@fipra.com',
			'Göran Thorstenson'             => 'goran.thorstenson@fipra.com',
			'Dominique Reber'               => 'dominique.reber@fipra.com',
			'Ayse Aricioglu'                => 'ayse.aricioglu@fipra.com',
			'Rory Chisholm'                 => 'rory.chisholm@fipra.com',
			'Abdul Waheed Patel'            => 'abdulwaheed.patel@fipra.com',
			'Sayer Aliyev'                  => 'sayer.aliyev@fipra.com',
			'Richard Andrew'                => 'richard.andrew@fipra.com',
			'Jose Luis Echevarria'          => 'joseluis.echevarria@fipra.com',
			'Peter van Keulen'              => 'peter.vankeulen@fipra.com',
			'Anders Rostin'                 => 'anders.rostin@fipra.com',
			'Lasha Gogiberidze'             => 'lasha.gogiberidze@fipra.com',
			'Mark Fielding'             => 'mark.fielding@fipra.com',
		];

		foreach ( $unit_lead_contacts as $unit => $contact ) {
			Unit_lead_contact::create(
				[
					'unit_name'         => $unit,
					'lead_contact_name' => $contact,
					'email'             => isset($lead_contact_emails[ $contact ]) ? $lead_contact_emails[ $contact ] : '',
					'rate_band'         => $unit_rate_bands[ $unit ],
				]
			);
		}
	}
}