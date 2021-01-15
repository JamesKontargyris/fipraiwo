<?php


class UnitLeadContactTableSeeder extends DatabaseSeeder {
	public function run() {

		Eloquent::unguard();

		DB::table( 'unit_lead_contacts' )->delete();

		$unit_lead_contacts = [
			'Fipra Australia'               => 'John Richardson',
			'Fipra Brazil'                  => 'José Gabriel Assis de Almeida',
			'Fipra Bulgaria'                => 'Rositsa Velkova',
			'Fipra Canada'                  => 'Andre Albinati',
			'Fipra China'                   => 'Haiying Yuan',
			'Fipra Croatia'                 => 'Natko Vlahovic',
			'Fipra Cyprus (New Unit)'       => 'Andreas Hadjikyriacos',
			'Fipra Czech Republic'          => 'Jana Marco',
			'Fipra Denmark'                 => 'Lars Abel',
			'Fipra Estonia'                 => 'Andreas Kaju',
			'Fipra Finland'                 => 'Ilari Marzano',
			'Fipra France'                  => 'Thaima Samman',
			'Fipra Germany (New Unit)'      => 'Dominik Meier',
			'Fipra Greece'                  => 'Anthony Gortzis',
			'Fipra Hungary'                 => 'Tamás Sárdi',
			'Fipra India'                   => 'Manash Neog',
			'Fipra International UK'        => 'Rory Chisholm',
			'Fipra International BE'        => '',
			'Fipra Ireland'                 => 'Lucinda Creighton',
			'Fipra Italy'                   => 'Mariella Palazzolo',
			'Fipra Japan'                   => 'Philip Howard',
			'Fipra Latvia'                  => 'Armands Gutmanis',
			'Fipra Lithuania'               => 'Arūnas Pemkus',
			'Fipra Netherlands'             => 'Peter van Keulen',
			'Fipra Norway'                  => 'Per Høiby',
			'Fipra Poland'                  => 'Marek Matraszek',
			'Fipra Portugal'                => 'Ana Vila Nova',
			'Fipra Saudi Arabia'            => 'Abdullah Nassief',
			'Fipra Singapore'               => 'Richard Andrew',
			'Fipra Slovakia'                => 'Patrik Zoltvany',
			'Fipra Slovenia'                => 'Mihael Cigler',
			'Fipra South Africa (New Unit)' => 'Abdul Waheed Patel',
			'Fipra South Korea'             => 'Joseph Chung',
			'Fipra Spain'                   => 'Sebastian Mariz',
			'Fipra Sweden'                  => 'Anders Rostin',
			'Fipra Switzerland'             => 'Dominique Reber',
			'Fipra Turkey'                  => 'Ayse Aricioglu',
			'Fipra Ukraine'                 => 'Ivan Poltavets',
			'Fipra Uruguay (New Unit)'      => 'Jose Luis Echevarria',
			'Fipra Georgia (New Unit)'      => 'Lasha Gogiberidze',
			'Fipra Austria (New Unit)'      => 'Markus Schindler',
			'Fipra UK'                      => 'Michael Craven',
			'Fipra Morocco'                 => 'Adrian Fielding',
			'Fipra Argentina'               => 'Miguel Ángel Martínez',
			'Fipra Romania'                 => 'Danut Nicolae',
			'Fipra Russia'                  => 'Evgeny Roshkov',
			'Fipra Malta'                   => 'Martin Cauchi Inglott',
			'Fipra Azerbaijan'              => 'Sadyar Aliyev',
			'Fipra Colombia'                => 'Nicola Montorsi',
			'Fipra Cyprus'                  => 'Achilleas Demetriades',
			'Fipra France'                  => 'Jean-Francois Guichard',
			'Fipra Georgia'                 => 'Lasha Gogiberidze',
			'Fipra Hong Kong'               => 'Greg Shea',
			'Fipra Iceland'                 => 'Alp Mehmet',
			'Fipra Kazakhstan'              => 'Ruslan Zhemkov',
			'Fipra Luxembourg'              => 'Joe Huggard',
			'Fipra Malta'                   => 'Martin Cauchi-Inglott',
			'Fipra Sweden'                  => 'Anders Rostin',
			'Fipra Tunisia'                 => 'Ghazi Ben Ahmed',
			'Fipra US (California)'         => 'Rory Faber',
			'Fipra US (Texas)'              => 'Russ Keene',
		];

		$unit_rate_bands = [
			'Fipra Argentina'               => 'low',
			'Fipra Australia'               => 'high',
			'Fipra Brazil'                  => 'low',
			'Fipra Bulgaria'                => 'low',
			'Fipra Canada'                  => 'high',
			'Fipra China'                   => 'high',
			'Fipra Croatia'                 => 'low',
			'Fipra Cyprus (New Unit)'       => 'low',
			'Fipra Czech Republic'          => 'low',
			'Fipra Denmark'                 => 'high',
			'Fipra Estonia'                 => 'low',
			'Fipra Finland'                 => 'high',
			'Fipra France'                  => 'high',
			'Fipra Germany (New Unit)'      => 'high',
			'Fipra Greece'                  => 'low',
			'Fipra Hungary'                 => 'low',
			'Fipra India'                   => 'low',
			'Fipra International UK'        => 'high',
			'Fipra International BE'        => 'high',
			'Fipra Ireland'                 => 'high',
			'Fipra Italy'                   => 'high',
			'Fipra Japan'                   => 'high',
			'Fipra Latvia'                  => 'low',
			'Fipra Libya'                   => 'low',
			'Fipra Lithuania'               => 'low',
			'Fipra Netherlands'             => 'high',
			'Fipra Norway'                  => 'high',
			'Fipra Poland'                  => 'low',
			'Fipra Portugal'                => 'low',
			'Fipra Saudi Arabia'            => 'low',
			'Fipra Singapore'               => 'high',
			'Fipra Slovakia'                => 'low',
			'Fipra Slovenia'                => 'low',
			'Fipra South Africa (New Unit)' => 'low',
			'Fipra South Korea'             => 'high',
			'Fipra Spain'                   => 'low',
			'Fipra Sweden'                  => 'high',
			'Fipra Switzerland'             => 'high',
			'Fipra Turkey'                  => 'low',
			'Fipra Ukraine'                 => 'low',
			'Fipra Uruguay (New Unit)'      => 'low',
			'Fipra Georgia (New Unit)'      => 'low',
			'Fipra Austria (New Unit)'      => 'high',
			'Fipra UK'                      => 'high',
			'Fipra Morocco'                 => 'low',
			'Fipra Romania'                 => 'low',
			'Fipra Russia'                  => 'low',
			'Fipra Malta'                   => 'low',
			'Fipra Azerbaijan'              => 'low',
			'Fipra Colombia'                => 'low',
			'Fipra Cyprus'                  => 'low',
			'Fipra France'                  => 'high',
			'Fipra Georgia'                 => 'low',
			'Fipra Hong Kong'               => 'low',
			'Fipra Iceland'                 => 'high',
			'Fipra Kazakhstan'              => 'low',
			'Fipra Luxembourg'              => 'high',
			'Fipra Malta'                   => 'low',
			'Fipra Sweden'                  => 'high',
			'Fipra Tunisia'                 => 'low',
			'Fipra US (California)'         => 'high',
			'Fipra US (Texas)'              => 'high',
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
			'Dominik Meier'                 => 'dominik.meier@fipra.com',
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
			'Mark Fielding'                 => 'mark.fielding@fipra.com',
			'Markus Schindler'              => 'markus.schindler@fipra.com',
			'Ivan Poltavets'                => 'ivan.poltavets@fipra.com',
			'Rory Chisholm'                 => 'rory.chisholm@fipra.com',
			'Michael Craven'                => 'michael.craven@fipra.com',
			'Adrian Fielding'               => 'adrian.fielding@fipra.com',
			'Miguel Ángel Martínez'         => 'miguel.angelmartinez@fipra.com',
			'Danut Nicolae'                 => 'danut.nicolae@fipra.com',
			'Evgeny Roshkov'                => 'evgeny.roshkov@fipra.com',
			'Thaima Samman'                 => 'thaima.samman@fipra.com',
			'Lucinda Creighton'             => 'lucinda.creighton@fipra.com',
			'Michael Craven'                => 'michael.craven@fipra.com',
			'Yongbai Cho'                   => 'yongbai.cho@fipra.com',
			'Abdullah Nassief'              => 'abdullah.nassief@fipra.com',
			'Martin Cauchi Inglott'         => 'martin.cauchiinglott@fipra.com',
			'Joseph Chung'                  => 'joseph.chung@fipra.com',
			'Sadyar Aliyev'                 => 'sadyar.aliyev@fipra.com',
			'Nicola Montorsi'               => 'nicola.montorsi@fipra.com',
			'Achilleas Demetriades'         => 'achilleas.demetriades@fipra.com',
			'Jean-Francois Guichard'        => 'jeanfrancois.guichard@fipra.com',
			'Lasha Gogiberidze'             => 'lasha.gogiberidze@fipra.com',
			'Greg Shea'                     => 'greg.shea@fipra.com',
			'Alp Mehmet'                    => 'alp.mehmet@fipra.com',
			'Ruslan Zhemkov'                => 'ruslan.zhemkov@fipra.com',
			'Joe Huggard'                   => 'joe.huggard@fipra.com',
			'Martin Cauchi-Inglott'         => 'martin.cauchiinglott@fipra.com',
			'Anders Rostin'                 => 'anders.rostin@fipra.com',
			'Ghazi Ben Ahmed'               => 'ghazi.benahmed@fipra.com',
			'Rory Faber'                    => 'rory.faber@fipra.com',
			'Russ Keene'                    => 'russ.keene@fipra.com',
		];

		foreach ( $unit_lead_contacts as $unit => $contact ) {
			Unit_lead_contact::create(
				[
					'unit_name'         => $unit,
					'lead_contact_name' => $contact,
					'email'             => isset( $lead_contact_emails[ $contact ] ) ? $lead_contact_emails[ $contact ] : '',
					'rate_band'         => $unit_rate_bands[ $unit ],
				]
			);
		}
	}
}