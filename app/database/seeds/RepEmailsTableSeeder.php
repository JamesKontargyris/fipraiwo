<?php

class RepEmailsTableSeeder extends DatabaseSeeder
{
    public function run()
    {
        Eloquent::unguard();

        DB::table('rep_emails')->delete();

        $email = [
            'Jan Ahlskog'         => 'jan.ahlskog@fipra.com',
            'Laura Batchelor'     => 'laura.batchelor@fipra.com',
            'Paul Buffet'         => 'paul.buffet@fipra.com',
            'Rory Chisholm'       => 'rory.chisholm@fipra.com',
            'Mark Fielding' => 'mark.fielding@fipra.com',
            'Dirk Hudig'          => 'dirk.hudig@fipra.com',
            'Hilary Hudson' => 'hilary.hudson@fipra.com',
            'David Lawsky'        => 'david.lawsky@fipra.com',
            'Peter-Carlo Lehrell' => 'lehrell@fipra.com',
            'Willem Vriesendorp' => 'willem.vriesendorp@fipra.com',
        ];

        foreach ($email as $name => $address) {
            Rep_email::create(
                [
                    'rep_name'  => $name,
                    'rep_email' => $address,
                ]
            );
        }
    }
}