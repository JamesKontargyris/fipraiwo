<?php

class SpadRepsTableSeeder extends DatabaseSeeder
{
    public function run()
    {
        Eloquent::unguard();

        DB::table('spad_reps')->delete();

        $spad_reps = [
            "Alfredo Acebal"         => "Peter-Carlo Lehrell",
            "Leila Alieva"           => "Peter-Carlo Lehrell",
            "Lorenzo Allio"          => "Dirk Hudig",
            "Stephanie Ayres"        => "Rory Chisholm",
            "John B. Richardson"     => "Dirk Hudig",
            "Bob Bennett"            => "Peter-Carlo Lehrell",
            "Catherine Bent"         => "Ann Kelly",
            "Rainer Boden"           => "Dirk Hudig",
            "John Bowis"             => "Laura Batchelor",
            "Carol Brosgart"         => "Laura Batchelor",
            "Marc Brykman"           => "Dirk Hudig",
            'Raman Chadha'           => 'Peter-Carlo Lehrell',
            "Michael D’Arcy"         => "Ann Kelly",
            "Willem de Ruiter"       => "Peter-Carlo Lehrell",
            "Achilleas Demetriades"  => "Peter-Carlo Lehrell",
            "Humbert Drabbe"         => "Dirk Hudig",
            'Jos Draijer'            => 'Laura Batchelor',
            'Hans de Belder'         => 'Ann Kelly',
            "Rory Faber"             => "Rory Chisholm",
            "Antonio Fournier"       => "Peter-Carlo Lehrell",
            'Stein Jacob Frisch'     => 'Peter-Carlo Lehrell',
            "Carles Gasòliba"        => "Peter-Carlo Lehrell",
            "Michael Goldinger"      => "Peter-Carlo Lehrell",
            "John Gore"              => "Dirk Hudig",
            "Rauf Gritli"            => "Peter-Carlo Lehrell",
            "Jean Francois Guichard" => "Laura Batchelor",
            "Stuart Harbinson"       => "Peter-Carlo Lehrell",
            "Kalevi Hemilä"          => "Jan Ahlskog",
            "Scott Hoeflich"         => "Rory Chisholm",
            "Jörgen Holgersson"      => "Peter-Carlo Lehrell",
            "Joe Huggard"            => "Laura Batchelor",
            "Russ Keene"             => "Peter-Carlo Lehrell",
            "Stephen Labaton"        => "Rory Chisholm",
            "John Maré"              => "Jan Ahlskog",
            "Hans Martens"           => "Dirk Hudig",
            "Jonathan May"           => "Rory Chisholm",
            "David McDonald Joyce"   => "Peter-Carlo Lehrell",
            "Sam McEwan"             => "Rory Chisholm",
            "Alp Mehmet"             => "Peter-Carlo Lehrell",
            "Bernard Merkel"         => "Laura Batchelor",
            'Vladimir Metelsky'      => 'Peter-Carlo Lehrell',
            "Nicola Montorsi"        => "Peter-Carlo Lehrell",
            "John Moore"             => "Peter-Carlo Lehrell",
            "Abdullah Nassief"       => "Peter-Carlo Lehrell",
            'Jenni Newman'           => 'Jan Ahlskog',
            'Danut Nicolae'          => 'Rory Chisholm',
            'Una O Dwyer'            => 'Ann Kelly',
            "Jenni Newman"           => "Jan Ahlskog",
            "Flor O'Mahony"          => "Peter-Carlo Lehrell",
            "Juan Prat y Coll"       => "Jan Ahlskog",
            "John Prideaux"          => "Peter-Carlo Lehrell",
            "Shan Ramburuth"         => "Phil Evans",
            "Julius Sen"             => "Phil Evans",
            'Sabine Seeger'          => 'David Lawsky',
            "Greg Shea"              => "Peter-Carlo Lehrell",
            "Alexander Shelemekh"    => "Peter-Carlo Lehrell",
            "Rimantas Stanikūnas"    => "Jan Ahlskog",
            "Peter Tulkens"          => "Laura Batchelor",
            "John Tzoannos"          => "Peter-Carlo Lehrell",
            "Anton Van der Lande"    => "Dirk Hudig",
            "Paul Vandoren"          => "Dirk Hudig",
            "Joris Vos"              => "Ukko Metsola",
            "Richard Wainwright"     => "Dirk Hudig",
            "Rob Walton"             => "Laura Batchelor",
            "Florus Wijsenbeek"      => "Peter-Carlo Lehrell",
            'Mikhail Yurlov'         => 'Peter-Carlo Lehrell',
            'Gianluca Comin'         => 'Mariella Palazzolo',
            'Krzysztof Lisek'        => 'Ukko Metsola',
        ];

        foreach ($spad_reps as $spad => $rep) {
            Spad_rep::create(
                [
                    'spad' => $spad,
                    'rep'  => $rep,
                ]
            );
        }
    }
} 