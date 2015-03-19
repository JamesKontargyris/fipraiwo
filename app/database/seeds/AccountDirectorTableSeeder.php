<?php


class AccountDirectorTableSeeder extends DatabaseSeeder
{
    public function run()
    {
        Eloquent::unguard();

        DB::table('account_directors')->delete();

        $account_directors = [
            'Ann Kelly'           => 'ann.kelly@fipra.com',
            'David Lawsky'        => 'david.lawsky@fipra.com',
            'Dirk Hudig'          => 'dirk.hudig@fipra.com',
            'Jan Ahlskog'         => 'jan.ahlskog@fipra.com',
            'John Gray'           => 'john.gray@fipra.com',
            'Laura Batchelor'     => 'laura.batchelor@fipra.com',
            'Peter-Carlo Lehrell' => 'lehrell@fipra.com',
            'Mark MacGann'        => 'mark.macgann@fipra.com',
            'Paul Buffet'         => 'paul.buffet@fipra.com',
            'Nathalie Hesketh'    => 'nathalie.hesketh@fipra.com',
            'Phil Evans'          => 'phil.evans@fipra.com',
            'Rory Chisholm'       => 'rory.chisholm@fipra.com',
            'Ukko Metsola'        => 'ukko.metsola@fipra.com',
            'Paul Buffet'         => 'paul.buffet@fipra.com'
        ];

        foreach ($account_directors as $name => $email) {
            Account_director::create(
                [
                    'name'  => $name,
                    'email' => $email
                ]
            );
        }
    }
} 