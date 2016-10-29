<?php


class AccountDirectorTableSeeder extends DatabaseSeeder
{
    public function run()
    {
        Eloquent::unguard();

        DB::table('account_directors')->delete();

        $account_directors = [
            'David Lawsky' => 'david.lawsky@fipra.com',
            'Dirk Hudig' => 'dirk.hudig@fipra.com',
            'Laura Batchelor' => 'laura.batchelor@fipra.com',
            'Peter-Carlo Lehrell' => 'mark.fielding@fipra.com',
            'Paul Buffet' => 'paul.buffet@fipra.com',
            'Rory Chisholm' => 'rory.chisholm@fipra.com',
            'Paul Buffet' => 'paul.buffet@fipra.com',
            'Hilary Hudson' => 'hilary.hudson@fipra.com',
            'Willem Vriesendorp' => 'willem.vriesendorp@fipra.com',
        ];

        foreach ($account_directors as $name => $email) {
            Account_director::create(
                [
                    'name' => $name,
                    'email' => $email
                ]
            );
        }
    }
} 