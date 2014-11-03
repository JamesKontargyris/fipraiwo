<?php


class UnitRepsTableSeeder extends DatabaseSeeder
{
    public function run()
    {
        Eloquent::unguard();

        DB::table('unit_reps')->delete();

        $unit_reps = [
            'Fipra Australia'      => 'Peter-Carlo Lehrell',
            'Fipra Belarus'        => 'Peter-Carlo Lehrell',
            'Fipra Brazil'         => 'Peter-Carlo Lehrell',
            'Fipra Bulgaria'       => 'David Lawsky',
            'Fipra Canada'         => 'Nathalie Hesketh',
            'Fipra China'          => 'Rory Chisholm',
            'Fipra Columbia'       => 'Peter-Carlo Lehrell',
            'Fipra Croatia'        => 'Peter-Carlo Lehrell',
            'Fipra Czech Republic' => 'Peter-Carlo Lehrell',
            'Fipra Denmark'        => 'Jan Ahlskog',
            'Fipra Estonia'        => 'Jan Ahlskog',
            'Fipra Finland'        => 'Jan Ahlskog',
            'Fipra France'         => 'Laura Batchelor',
            'Fipra Germany'        => 'Peter-Carlo Lehrell',
            'Fipra Hungary'        => 'Rory Chisholm',
            'Fipra India'          => 'Peter-Carlo Lehrell',
            'Fipra International'  => 'Peter-Carlo Lehrell',
            'Fipra Ireland'        => 'Ann Kelly',
            'Fipra Italy'          => 'Laura Batchelor',
            'Fipra Japan'          => 'Peter-Carlo Lehrell',
            'Fipra South Korea'    => 'David Lawsky',
            'Fipra Latvia'         => 'Jan Ahlskog',
            'Fipra Lithuania'      => 'Jan Ahlskog',
            'Fipra Malta'          => 'Ukko Metsola',
            'Fipra Netherlands'    => 'Dirk Hudig',
            'Fipra Norway'         => 'Jan Ahlskog',
            'Fipra Poland'         => 'Rory Chisholm',
            'Fipra Portugal'       => 'Laura Batchelor',
            'Fipra Romania'        => 'Rory Chisholm',
            'Fipra Russia'         => 'Peter-Carlo Lehrell',
            'Fipra Slovakia'       => 'Peter-Carlo Lehrell',
            'Fipra Slovenia'       => 'Peter-Carlo Lehrell',
            'Fipra South Africa'   => 'Jan Ahlskog',
            'Fipra Spain'          => 'Peter-Carlo Lehrell',
            'Fipra Sweden'         => 'Jan Ahlskog',
            'Fipra Switzerland'    => 'Peter-Carlo Lehrell',
            'Fipra Turkey'         => 'Peter-Carlo Lehrell',
            'Fipra Ukraine'        => 'Dirk Hudig',
            'Fipra United Kingdom' => 'Rory Chisholm',
        ];

        foreach ($unit_reps as $unit => $rep)
        {
            Unit_rep::create([
                'fipra_unit' => $unit,
                'rep'        => $rep,
            ]);
        }
    }
} 