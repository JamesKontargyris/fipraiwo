<?php

class SpadRepsTableSeeder extends DatabaseSeeder
{
    public function run()
    {
        Eloquent::unguard();

        DB::table('spad_reps')->delete();

        $spad_reps = [
            'John Bowis'            => 'Laura Batchelor',
            'Carol Brosgart'        => 'Laura Batchelor',
            'Marc Brykman'          => 'Dirk Hudig',
            'Willem de Ruiter'      => 'Peter-Carlo Lehrell',
            'Achilleas Demetriades' => 'Peter-Carlo Lehrell',
            'Humbert Drabbe'        => 'Dirk Hudig',
            'Rory Faber'            => 'Rory Chisholm',
            'Antonio Fournier'      => 'Peter-Carlo Lehrell',
            'Carles Gasòliba'       => 'Peter-Carlo Lehrell',
            'Marc Glesener'         => 'Peter-Carlo Lehrell',
            'Michael Goldinger'     => 'Peter-Carlo Lehrell',
            'John Gore'             => 'Dirk Hudig',
            'Rauf Gritli'           => 'Peter-Carlo Lehrell',
            'Stuart Harbinson'      => 'Peter-Carlo Lehrell',
            'Kalevi Hemilä'         => 'Jan Ahlskog',
            'Jörgen Holgersson'     => 'Peter-Carlo Lehrell',
            'Joe Huggard'           => 'Laura Batchelor',
            'Russ Keene'            => 'Sebastian Vos',
            'Helene Lloyd'          => 'Peter-Carlo Lehrell',
            'John Maré'             => 'Jan Ahlskog',
            'Hans Martens'          => 'Dirk Hudig',
            'Jonathan May'          => 'Rory Chisholm',
            'David McDonald Joyce'  => 'Peter-Carlo Lehrell',
            'Sam McEwan'            => 'Rory Chisholm',
            'Alp Mehmet'            => 'Peter-Carlo Lehrell',
            'Nicola Montorsi'       => 'Peter-Carlo Lehrell',
            'John Moore'            => 'Peter-Carlo Lehrell',
            'Abdullah Nassief'      => 'Peter-Carlo Lehrell',
            'Flor O Mahony'         => 'Peter-Carlo Lehrell',
            'Juan Prat y Coll'      => 'Jan Ahlskog',
            'John Prideaux'         => 'Peter-Carlo Lehrell',
            'John B. Richardson'    => 'Dirk Hudig',
            'Julius Sen'            => 'Phil Evans',
            'Greg Shea'             => 'Peter-Carlo Lehrell',
            'Alexander Shelemekh'   => 'Peter-Carlo Lehrell',
            'Rimantas Stanikūnas'   => 'Jan Ahlskog',
            'Peter Tulkens'         => 'Laura Batchelor',
            'John Tzoannos'         => 'Peter-Carlo Lehrell',
            'Anton Van der Lande'   => 'Sebastian Vos',
            'Paul Vandoren'         => 'Dirk Hudig',
            'Joris Vos'             => 'Ukko Metsola',
            'Richard Wainwright'    => 'Dirk Hudig',
            'Rob Walton'            => 'Laura Batchelor',
            'Florus Wijsenbeek'     => 'Peter-Carlo Lehrell',
            'Catherine Bent'        => 'Ann Kelly',
            'Michael D’Arcy'        => 'Ann Kelly',
            'Allan Fels'            => 'Phil Evans',
            'Scott Hoeflich'        => 'Rory Chisholm',
            'Stephen Labaton'       => 'Rory Chisholm',
            'Bernard Merkel'        => 'Laura Batchelor',
            'Shan Ramburuth '       => 'Phil Evans'
        ];

        foreach ($spad_reps as $spad => $rep)
        {
            Spad_rep::create([
                    'spad' => $spad,
                    'rep'  => $rep
                ]

            );
        }
    }
} 