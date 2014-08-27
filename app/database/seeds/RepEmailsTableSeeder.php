

<?php

class RepEmailsTableSeeder extends DatabaseSeeder
{
    public function run()
    {
        Eloquent::unguard();

        DB::table('rep_emails')->delete();

        $email = [
            'Peter-Carlo Lehrell' => 'lehrell@fipra.com',
            'David Lawsky' => 'david.lawsky@fipra.com',
            'Nathalie Hesketh' => 'nathalie.hesketh@fipra.com',
            'Sebastian Vos' => 'sebastian.vos@fipra.com',
            'Jan Ahlskog' => 'jan.ahlskog@fipra.com',
            'Laura Batchelor' => 'laura.batchelor@fipra.com',
            'Ukko Metsola' => 'ukko.metsola@fipra.com',
            'Rory Chisholm' => 'rory.chisholm@fipra.com',
            'Dirk Hudig' => 'dirk.hudig@fipra.com',
            'Ann Kelly' => 'dirk.hudig@fipra.com',
            'Phil Evans' => 'phil.evans@fipra.com',
        ];

        foreach ($email as $name => $address)
        {
            Rep_email::create([
                'rep_name' => $name,
                'rep_email'  => $address,
            ]);
        }
    }
}