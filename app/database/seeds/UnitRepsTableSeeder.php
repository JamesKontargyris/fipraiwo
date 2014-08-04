<?php


class UnitRepsTableSeeder extends DatabaseSeeder
{
    public function run()
    {
        Eloquent::unguard();

        DB::table('unit_reps')->delete();

        $unit_reps = [
            'Fipra Australia' => 'Peter-Carlo Lehrell',
            'Fipra Brazil' => 'Peter-Carlo Lehrell',
            'Fipra Bulgaria' => 'David Lawsky',
            'Fipra Canada' => 'Nathalie Hesketh',
            'Fipra Croatia' => 'Peter-Carlo Lehrell',
            'Fipra Czech Republic' => 'Sebastian Vos',
            'Fipra Denmark' => 'Jan Ahlskog',
            'Fipra Estonia' => 'Jan Ahlskog',
            'Fipra Finland' => 'Jan Ahlskog',
            'Fipra France' => 'Laura Batchelor',
            'Fipra Germany' => 'Peter-Carlo Lehrell',
            'Fipra Hungary' => 'Rory Chisholm',
            'Fipra India' => 'Peter-Carlo Lehrell',
            'Fipra Ireland' => 'Ann Kelly',
            'Fipra Italy' => 'Peter-Carlo Lehrell',
            'Fipra Japan' => 'Peter-Carlo Lehrell',
            'Fipra South Korea' => 'David Lawsky',
            'Fipra Latvia' => 'Jan Ahlskog',
            'Fipra Lithuania' => 'Jan Ahlskog',
            'Fipra Malta' => 'Ukko Metsola',
            'Fipra Netherlands' => 'Sebastian Vos',
            'Fipra Norway' => 'Jan Ahlskog',
            'Fipra Poland' => 'Rory Chisholm',
            'Fipra Portugal' => 'Laura Batchelor',
            'Fipra Romania' => 'Rory Chisholm',
            'Fipra Slovakia' => 'Sebastian Vos',
            'Fipra Slovenia' => 'Peter-Carlo Lehrell',
            'Fipra Spain' => 'Sebastian Vos',
            'Fipra Sweden' => 'Jan Ahlskog',
            'Fipra Switzerland' => 'Peter-Carlo Lehrell',
            'Fipra Turkey' => 'Peter-Carlo Lehrell',
            'Fipra Ukraine' => 'Dirk Hudig',
            'Fipra United Kingdom' => 'Rory Chisholm',
            'Belarus' => 'Peter-Carlo Lehrell',
            'China' => 'Rory Chisholm',
            'Columbia' => 'Peter-Carlo Lehrell',
            'India' => 'Peter-Carlo Lehrell',
            'Russia' => 'Peter-Carlo Lehrell',
            'South Africa' => 'Sebastian Vos'
        ];

        foreach($unit_reps as $unit => $rep)
        {
            Unit_rep::create([
                'fipra_unit' => $unit,
                'rep' => $rep
            ]

            );
        }
    }
} 