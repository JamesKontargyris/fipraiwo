<?php


class UnitRepsTableSeeder extends DatabaseSeeder
{
    public function run()
    {
        Eloquent::unguard();

        DB::table('unit_reps')->delete();

        $unit_reps = [
            'Fipra Africa'         => 'Mark Fielding',
            'Fipra Australia'      => 'Paul Buffet',
            'Fipra Azerbaijan'     => 'Paul Buffet',
            'Fipra Brazil'         => 'Paul Buffet',
            'Fipra Bulgaria'       => 'Rory Chisholm',
            'Fipra Canada'         => 'David Lawsky',
            'Fipra China'          => 'Mark Fielding',
            'Fipra Croatia'        => 'Natko Vlahovic',
            'Fipra Cyprus'         => 'Laura Batchelor',
            'Fipra Czech Republic' => 'Rory Chisholm',
            'Fipra Denmark'        => 'Jan Ahlskog',
            'Fipra Estonia'        => 'Jan Ahlskog',
            'Fipra Finland'        => 'Jan Ahlskog',
            'Fipra France'         => 'Laura Batchelor',
            'Fipra Germany'        => 'Peter-Carlo Lehrell',
            'Fipra Greece'         => 'Hilary Hudson',
            'Fipra Hungary'        => 'Rory Chisholm',
            'Fipra India'          => 'Mark Fielding',
//            'Fipra International'  => '',
            'Fipra Ireland'        => 'Laura Batchelor',
            'Fipra Italy'          => 'Laura Batchelor',
            'Fipra Japan'          => 'Mark Fielding',
            'Fipra South Korea'    => 'Mark Fielding',
            'Fipra Latvia'         => 'Jan Ahlskog',
            'Fipra Lithuania'      => 'Jan Ahlskog',
            'Fipra Netherlands'    => 'Dirk Hudig',
            'Fipra Norway'         => 'Jan Ahlskog',
            'Fipra Poland'         => 'Rory Chisholm',
            'Fipra Portugal'       => 'Laura Batchelor',
            'Fipra Singapore'      => 'Mark Fielding',
            'Fipra Slovakia'       => 'Laura Batchelor',
            'Fipra Slovenia'       => 'Rory Chisholm',
            'Fipra Spain'          => 'Laura Batchelor',
            'Fipra Sweden'         => 'Jan Ahlskog',
            'Fipra Switzerland'    => 'Mark Fielding',
            'Fipra Turkey'         => 'Mark Fielding',
            'Fipra Ukraine'        => 'Dirk Hudig',
            'Fipra United Kingdom' => 'Rory Chisholm',
            'Fipra Uruguay'        => 'Laura Batchelor'
        ];

        foreach ($unit_reps as $unit => $rep) {
            Unit_rep::create(
                [
                    'fipra_unit' => $unit,
                    'rep'        => $rep,
                ]
            );
        }
    }
} 