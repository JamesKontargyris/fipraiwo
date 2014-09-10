<?php

class SpadEmailsTableSeeder extends DatabaseSeeder {
	public function run() {
		Eloquent::unguard();

		DB::table( 'spad_emails' )->delete();

		$email = [
			'Alfredo Acebal'        => 'alfredo.acebal@fipra.com',
			'Leila Alieva'          => 'leila.alieva@fipra.com',
			'Lorenzo Allio'         => 'lorenzo.allio@fipra.com',
			'Stephanie Ayres'       => 'stephanie.ayres@fipra.com',
			'John B. Richardson'    => 'john.richardson@fipra.com',
			'Bob Bennett'           => 'bob.bennett@fipra.com',
			'Catherine Bent'        => 'catherine.bent@fipra.com',
			'Martina Bianchini'     => 'martina.bianchini@fipra.com',
			'Rainer Boden'          => 'rainer.boden@fipra.com',
			'John Bowis'            => 'john.bowis@fipra.com',
			'Carol Brosgart'        => 'carol.brosgart@fipra.com',
			'Marc Brykman'          => 'marc.brykman@fipra.com',
			'Michael D’Arcy'        => 'michael.d’arcy@fipra.com',
			'Willem de Ruiter'      => 'willem.deruiter@fipra.com',
			'Achilleas Demetriades' => 'achilleas.demetriades@fipra.com',
			'Humbert Drabbe'        => 'humbert.drabbe@fipra.com',
			'Rory Faber'            => 'rory.faber@fipra.com',
			'Allan Fels'            => 'allan.fels@fipra.com',
			'Antonio Fournier'      => 'antonio.fournier@fipra.com',
			'Carles Gasòliba'       => 'carles.gasòliba@fipra.com',
			'Marc Glesener'         => 'marc.glesener@fipra.com',
			'Michael Goldinger'     => 'michael.goldinger@fipra.com',
			'John Gore'             => 'john.gore@fipra.com',
			'Rauf Gritli'           => 'rauf.gritli@fipra.com',
			'Stuart Harbinson'      => 'stuart.harbinson@fipra.com',
			'Kalevi Hemilä'         => 'kalevi.hemilä@fipra.com',
			'Scott Hoeflich'        => 'scott.hoeflich@fipra.com',
			'Jörgen Holgersson'     => 'jorgen.holgersson@fipra.com',
			'Joe Huggard'           => 'joe.huggard@fipra.com',
			'Russ Keene'            => 'russ.keene@fipra.com',
			'Stephen Labaton'       => 'stephen.labaton@fipra.com',
			'Helene Lloyd'          => 'helene.lloyd@fipra.com',
			'John Maré'             => 'john.maré@fipra.com',
			'Hans Martens'          => 'hans.martens@fipra.com',
			'Jonathan May'          => 'jonathan.may@fipra.com',
			'David McDonald Joyce'  => 'david.mcdonaldjoyce@fipra.com',
			'Sam McEwan'            => 'sam.mcewan@fipra.com',
			'Alp Mehmet'            => 'alp.mehmet@fipra.com',
			'Bernard Merkel'        => 'bernard.merkel@fipra.com',
			'Nicola Montorsi'       => 'nicola.montorsi@fipra.com',
			'John Moore'            => 'john.moore@fipra.com',
			'Abdullah Nassief'      => 'abdullah.nassief@fipra.com',
			'Flor OMahony'          => 'flor.omahony@fipra.com',
			'Juan Prat y Coll'      => 'juan.pratcoll@fipra.com',
			'John Prideaux'         => 'john.prideaux@fipra.com',
			'Shan Ramburuth'        => 'shan.ramburuth @fipra.com',
			'Julius Sen'            => 'julius.sen@fipra.com',
			'Greg Shea'             => 'greg.shea@fipra.com',
			'Alexander Shelemekh'   => 'alexander.shelemekh@fipra.com',
			'Rimantas Stanikūnas'   => 'rimantas.stanikunas@fipra.com',
			'Peter Tulkens'         => 'peter.tulkens@fipra.com',
			'John Tzoannos'         => 'john.tzoannos@fipra.com',
			'Anton Van der Lande'   => 'anton.vanderlande@fipra.com',
			'Paul Vandoren'         => 'paul.vandoren@fipra.com',
			'Joris Vos'             => 'joris.vos@fipra.com',
			'Richard Wainwright'    => 'richard.wainwright@fipra.com',
			'Rob Walton'            => 'rob.walton@fipra.com',
			'Florus Wijsenbeek'     => 'florus.wijsenbeek@fipra.com',

		];

		foreach ( $email as $name => $address ) {
			Spad_email::create( [
				'spad_name'  => $name,
				'spad_email' => $address,
			] );
		}
	}
}