<?php

class iwoTableSeeder extends Seeder {
    public function run()
    {
        
        DB::table('account_directors')->insert(array(
                    
            array(
                'id' => 85,
                'name' => 'Ann Kelly',
                'email' => 'ann.kelly@fipra.com',
            ),

            array(
                'id' => 86,
                'name' => 'David Lawsky',
                'email' => 'david.lawsky@fipra.com',
            ),

            array(
                'id' => 87,
                'name' => 'Dirk Hudig',
                'email' => 'dirk.hudig@fipra.com',
            ),

            array(
                'id' => 88,
                'name' => 'Jan Ahlskog',
                'email' => 'jan.ahlskog@fipra.com',
            ),

            array(
                'id' => 89,
                'name' => 'John Gray',
                'email' => 'john.gray@fipra.com',
            ),

            array(
                'id' => 90,
                'name' => 'Laura Batchelor',
                'email' => 'laura.batchelor@fipra.com',
            ),

            array(
                'id' => 91,
                'name' => 'Peter-Carlo Lehrell',
                'email' => 'lehrell@fipra.com',
            ),

            array(
                'id' => 92,
                'name' => 'Mark Macgann',
                'email' => 'mark.macgann@fipra.com',
            ),

            array(
                'id' => 93,
                'name' => 'Nathalie Hesketh',
                'email' => 'nathalie.hesketh@fipra.com',
            ),

            array(
                'id' => 94,
                'name' => 'Phil Evans',
                'email' => 'phil.evans@fipra.com',
            ),

            array(
                'id' => 95,
                'name' => 'Rory Chisholm',
                'email' => 'rory.chisholm@fipra.com',
            ),

            array(
                'id' => 96,
                'name' => 'Ukko Metsola',
                'email' => 'ukko.metsola@fipra.com',
            ),

        ));
        DB::table('assigned_roles')->insert(array(
                    
            array(
                'id' => 1,
                'user_id' => 1,
                'role_id' => 1,
            ),

            array(
                'id' => 2,
                'user_id' => 2,
                'role_id' => 2,
            ),

            array(
                'id' => 3,
                'user_id' => 3,
                'role_id' => 1,
            ),

            array(
                'id' => 4,
                'user_id' => 4,
                'role_id' => 2,
            ),

            array(
                'id' => 5,
                'user_id' => 6,
                'role_id' => 1,
            ),

            array(
                'id' => 6,
                'user_id' => 7,
                'role_id' => 2,
            ),

            array(
                'id' => 7,
                'user_id' => 8,
                'role_id' => 1,
            ),

            array(
                'id' => 8,
                'user_id' => 9,
                'role_id' => 2,
            ),

            array(
                'id' => 9,
                'user_id' => 10,
                'role_id' => 1,
            ),

            array(
                'id' => 10,
                'user_id' => 11,
                'role_id' => 2,
            ),

            array(
                'id' => 11,
                'user_id' => 12,
                'role_id' => 1,
            ),

            array(
                'id' => 12,
                'user_id' => 13,
                'role_id' => 2,
            ),

            array(
                'id' => 13,
                'user_id' => 14,
                'role_id' => 1,
            ),

            array(
                'id' => 14,
                'user_id' => 15,
                'role_id' => 2,
            ),

            array(
                'id' => 15,
                'user_id' => 16,
                'role_id' => 1,
            ),

            array(
                'id' => 16,
                'user_id' => 17,
                'role_id' => 2,
            ),

            array(
                'id' => 17,
                'user_id' => 18,
                'role_id' => 1,
            ),

            array(
                'id' => 18,
                'user_id' => 19,
                'role_id' => 2,
            ),

            array(
                'id' => 19,
                'user_id' => 20,
                'role_id' => 1,
            ),

            array(
                'id' => 20,
                'user_id' => 21,
                'role_id' => 2,
            ),

            array(
                'id' => 21,
                'user_id' => 22,
                'role_id' => 1,
            ),

            array(
                'id' => 22,
                'user_id' => 23,
                'role_id' => 2,
            ),

            array(
                'id' => 23,
                'user_id' => 24,
                'role_id' => 1,
            ),

            array(
                'id' => 24,
                'user_id' => 25,
                'role_id' => 2,
            ),

            array(
                'id' => 25,
                'user_id' => 26,
                'role_id' => 1,
            ),

            array(
                'id' => 26,
                'user_id' => 27,
                'role_id' => 2,
            ),

            array(
                'id' => 27,
                'user_id' => 28,
                'role_id' => 1,
            ),

            array(
                'id' => 28,
                'user_id' => 29,
                'role_id' => 2,
            ),

            array(
                'id' => 29,
                'user_id' => 30,
                'role_id' => 1,
            ),

            array(
                'id' => 30,
                'user_id' => 31,
                'role_id' => 2,
            ),

            array(
                'id' => 31,
                'user_id' => 32,
                'role_id' => 1,
            ),

            array(
                'id' => 32,
                'user_id' => 33,
                'role_id' => 2,
            ),

            array(
                'id' => 33,
                'user_id' => 34,
                'role_id' => 1,
            ),

            array(
                'id' => 34,
                'user_id' => 35,
                'role_id' => 2,
            ),

            array(
                'id' => 35,
                'user_id' => 36,
                'role_id' => 1,
            ),

            array(
                'id' => 36,
                'user_id' => 37,
                'role_id' => 2,
            ),

            array(
                'id' => 37,
                'user_id' => 38,
                'role_id' => 1,
            ),

            array(
                'id' => 38,
                'user_id' => 39,
                'role_id' => 2,
            ),

            array(
                'id' => 39,
                'user_id' => 40,
                'role_id' => 1,
            ),

            array(
                'id' => 40,
                'user_id' => 41,
                'role_id' => 2,
            ),

            array(
                'id' => 41,
                'user_id' => 42,
                'role_id' => 3,
            ),

            array(
                'id' => 42,
                'user_id' => 43,
                'role_id' => 1,
            ),

            array(
                'id' => 43,
                'user_id' => 44,
                'role_id' => 1,
            ),

            array(
                'id' => 44,
                'user_id' => 45,
                'role_id' => 1,
            ),

            array(
                'id' => 45,
                'user_id' => 46,
                'role_id' => 2,
            ),

            array(
                'id' => 46,
                'user_id' => 47,
                'role_id' => 1,
            ),

            array(
                'id' => 47,
                'user_id' => 48,
                'role_id' => 1,
            ),

            array(
                'id' => 48,
                'user_id' => 49,
                'role_id' => 2,
            ),

        ));
        DB::table('copy_contacts')->insert(array(
                    
            array(
                'id' => 1,
                'email' => 'jk@webfane.net',
                'name' => 'James Kontargyris',
                'formtype_id' => 2,
                'created_at' => '2014-04-28 18:00:00',
                'updated_at' => '2014-04-28 18:00:00',
            ),

            array(
                'id' => 2,
                'email' => 'james@jameskontargyris.co.uk',
                'name' => 'Helen Jones',
                'formtype_id' => 1,
                'created_at' => '2014-04-28 18:10:00',
                'updated_at' => '2014-04-28 18:10:00',
            ),

            array(
                'id' => 3,
                'email' => 'james@jameskontargyris.co.uk',
                'name' => 'James Kontargyris',
                'formtype_id' => 3,
                'created_at' => '2014-05-11 13:30:00',
                'updated_at' => '2014-05-11 13:30:00',
            ),

            array(
                'id' => 4,
                'email' => 'james@jameskontargyris.co.uk',
                'name' => 'James Kontargyris',
                'formtype_id' => 4,
                'created_at' => '2014-05-11 14:00:00',
                'updated_at' => '2014-05-11 14:00:00',
            ),

        ));
        DB::table('formtypes')->insert(array(
                    
            array(
                'id' => 1,
                'key' => 'edt',
                'title' => 'EDT Internal Work Order',
                'label' => 'EDT',
                'created_at' => '2014-04-28 17:30:00',
                'updated_at' => '2014-04-28 17:30:00',
            ),

            array(
                'id' => 2,
                'key' => 'unit',
                'title' => 'Units Internal Work Order',
                'label' => 'Units',
                'created_at' => '2014-04-28 17:30:00',
                'updated_at' => '2014-04-28 17:30:00',
            ),

            array(
                'id' => 3,
                'key' => 'spad',
                'title' => 'Special Advisers Internal Work Order',
                'label' => 'Special Advisers',
                'created_at' => '2014-04-28 17:30:00',
                'updated_at' => '2014-04-28 17:30:00',
            ),

            array(
                'id' => 4,
                'key' => 'fiplex',
                'title' => 'Fiplex Internal Work Order',
                'label' => 'Fiplex',
                'created_at' => '2014-04-28 17:30:00',
                'updated_at' => '2014-04-28 17:30:00',
            ),

            array(
                'id' => 5,
                'key' => 'fiptalk',
                'title' => 'Fiptalk Internal Work Order',
                'label' => 'Fiptalk',
                'created_at' => '2014-07-23 16:20:00',
                'updated_at' => '2014-07-23 16:20:00',
            ),

        ));
        DB::table('permission_role')->insert(array(
                    
            array(
                'id' => 1,
                'permission_id' => 1,
                'role_id' => 1,
            ),

            array(
                'id' => 2,
                'permission_id' => 2,
                'role_id' => 1,
            ),

            array(
                'id' => 4,
                'permission_id' => 1,
                'role_id' => 2,
            ),

            array(
                'id' => 5,
                'permission_id' => 3,
                'role_id' => 2,
            ),

            array(
                'id' => 6,
                'permission_id' => 4,
                'role_id' => 1,
            ),

            array(
                'id' => 7,
                'permission_id' => 5,
                'role_id' => 1,
            ),

            array(
                'id' => 8,
                'permission_id' => 5,
                'role_id' => 2,
            ),

            array(
                'id' => 9,
                'permission_id' => 1,
                'role_id' => 3,
            ),

            array(
                'id' => 10,
                'permission_id' => 2,
                'role_id' => 3,
            ),

            array(
                'id' => 11,
                'permission_id' => 3,
                'role_id' => 3,
            ),

            array(
                'id' => 12,
                'permission_id' => 4,
                'role_id' => 3,
            ),

            array(
                'id' => 13,
                'permission_id' => 5,
                'role_id' => 3,
            ),

        ));
        DB::table('permissions')->insert(array(
                    
            array(
                'id' => 1,
                'name' => 'read',
                'display_name' => 'Can Read IWOs',
                'created_at' => '2014-07-29 08:48:37',
                'updated_at' => '2014-07-29 08:48:37',
            ),

            array(
                'id' => 2,
                'name' => 'edit',
                'display_name' => 'Can Edit IWOs',
                'created_at' => '2014-07-29 08:48:37',
                'updated_at' => '2014-07-29 08:48:37',
            ),

            array(
                'id' => 3,
                'name' => 'confirm',
                'display_name' => 'Can Confirm IWOs',
                'created_at' => '2014-07-29 08:48:37',
                'updated_at' => '2014-07-29 08:48:37',
            ),

            array(
                'id' => 4,
                'name' => 'cancel',
                'display_name' => 'Can cancel IWOs',
                'created_at' => '2014-07-30 10:57:27',
                'updated_at' => '2014-07-30 10:57:27',
            ),

            array(
                'id' => 5,
                'name' => 'comment',
                'display_name' => 'Can add notes and comments to IWOs',
                'created_at' => '2014-07-30 11:07:01',
                'updated_at' => '2014-07-30 11:07:01',
            ),

        ));
        DB::table('roles')->insert(array(
                    
            array(
                'id' => 1,
                'name' => 'Lead',
                'created_at' => '2014-07-29 08:48:37',
                'updated_at' => '2014-07-29 08:48:37',
            ),

            array(
                'id' => 2,
                'name' => 'Sub',
                'created_at' => '2014-07-29 08:48:37',
                'updated_at' => '2014-07-29 08:48:37',
            ),

            array(
                'id' => 3,
                'name' => 'SuperUser',
                'created_at' => '2014-08-01 07:53:34',
                'updated_at' => '2014-08-01 07:53:34',
            ),

        ));
        DB::table('spad_reps')->insert(array(
                    
            array(
                'id' => 96,
                'spad' => 'John Bowis',
                'rep' => 'Laura Batchelor',
            ),

            array(
                'id' => 97,
                'spad' => 'Carol Brosgart',
                'rep' => 'Laura Batchelor',
            ),

            array(
                'id' => 98,
                'spad' => 'Marc Brykman',
                'rep' => 'Dirk Hudig',
            ),

            array(
                'id' => 99,
                'spad' => 'Willem de Ruiter',
                'rep' => 'Peter-Carlo Lehrell',
            ),

            array(
                'id' => 100,
                'spad' => 'Achilleas Demetriades',
                'rep' => 'Peter-Carlo Lehrell',
            ),

            array(
                'id' => 101,
                'spad' => 'Humbert Drabbe',
                'rep' => 'Dirk Hudig',
            ),

            array(
                'id' => 102,
                'spad' => 'Rory Faber',
                'rep' => 'Rory Chisholm',
            ),

            array(
                'id' => 103,
                'spad' => 'Antonio Fournier',
                'rep' => 'Peter-Carlo Lehrell',
            ),

            array(
                'id' => 104,
                'spad' => 'Carles Gasòliba',
                'rep' => 'Peter-Carlo Lehrell',
            ),

            array(
                'id' => 105,
                'spad' => 'Marc Glesener',
                'rep' => 'Peter-Carlo Lehrell',
            ),

            array(
                'id' => 106,
                'spad' => 'Michael Goldinger',
                'rep' => 'Peter-Carlo Lehrell',
            ),

            array(
                'id' => 107,
                'spad' => 'John Gore',
                'rep' => 'Dirk Hudig',
            ),

            array(
                'id' => 108,
                'spad' => 'Rauf Gritli',
                'rep' => 'Peter-Carlo Lehrell',
            ),

            array(
                'id' => 109,
                'spad' => 'Stuart Harbinson',
                'rep' => 'Peter-Carlo Lehrell',
            ),

            array(
                'id' => 110,
                'spad' => 'Kalevi Hemilä',
                'rep' => 'Jan Ahlskog',
            ),

            array(
                'id' => 111,
                'spad' => 'Jörgen Holgersson',
                'rep' => 'Peter-Carlo Lehrell',
            ),

            array(
                'id' => 112,
                'spad' => 'Joe Huggard',
                'rep' => 'Laura Batchelor',
            ),

            array(
                'id' => 113,
                'spad' => 'Russ Keene',
                'rep' => 'Sebastian Vos',
            ),

            array(
                'id' => 114,
                'spad' => 'Helene Lloyd',
                'rep' => 'Peter-Carlo Lehrell',
            ),

            array(
                'id' => 115,
                'spad' => 'John Maré',
                'rep' => 'Jan Ahlskog',
            ),

            array(
                'id' => 116,
                'spad' => 'Hans Martens',
                'rep' => 'Dirk Hudig',
            ),

            array(
                'id' => 117,
                'spad' => 'Jonathan May',
                'rep' => 'Rory Chisholm',
            ),

            array(
                'id' => 118,
                'spad' => 'David McDonald Joyce',
                'rep' => 'Peter-Carlo Lehrell',
            ),

            array(
                'id' => 119,
                'spad' => 'Sam McEwan',
                'rep' => 'Rory Chisholm',
            ),

            array(
                'id' => 120,
                'spad' => 'Alp Mehmet',
                'rep' => 'Peter-Carlo Lehrell',
            ),

            array(
                'id' => 121,
                'spad' => 'Nicola Montorsi',
                'rep' => 'Peter-Carlo Lehrell',
            ),

            array(
                'id' => 122,
                'spad' => 'John Moore',
                'rep' => 'Peter-Carlo Lehrell',
            ),

            array(
                'id' => 123,
                'spad' => 'Abdullah Nassief',
                'rep' => 'Peter-Carlo Lehrell',
            ),

            array(
                'id' => 124,
                'spad' => 'Flor O Mahony',
                'rep' => 'Peter-Carlo Lehrell',
            ),

            array(
                'id' => 125,
                'spad' => 'Juan Prat y Coll',
                'rep' => 'Jan Ahlskog',
            ),

            array(
                'id' => 126,
                'spad' => 'John Prideaux',
                'rep' => 'Peter-Carlo Lehrell',
            ),

            array(
                'id' => 127,
                'spad' => 'John B. Richardson',
                'rep' => 'Dirk Hudig',
            ),

            array(
                'id' => 128,
                'spad' => 'Julius Sen',
                'rep' => 'Phil Evans',
            ),

            array(
                'id' => 129,
                'spad' => 'Greg Shea',
                'rep' => 'Peter-Carlo Lehrell',
            ),

            array(
                'id' => 130,
                'spad' => 'Alexander Shelemekh',
                'rep' => 'Peter-Carlo Lehrell',
            ),

            array(
                'id' => 131,
                'spad' => 'Rimantas Stanikūnas',
                'rep' => 'Jan Ahlskog',
            ),

            array(
                'id' => 132,
                'spad' => 'Peter Tulkens',
                'rep' => 'Laura Batchelor',
            ),

            array(
                'id' => 133,
                'spad' => 'John Tzoannos',
                'rep' => 'Peter-Carlo Lehrell',
            ),

            array(
                'id' => 134,
                'spad' => 'Anton Van der Lande',
                'rep' => 'Sebastian Vos',
            ),

            array(
                'id' => 135,
                'spad' => 'Paul Vandoren',
                'rep' => 'Dirk Hudig',
            ),

            array(
                'id' => 136,
                'spad' => 'Joris Vos',
                'rep' => 'Ukko Metsola',
            ),

            array(
                'id' => 137,
                'spad' => 'Richard Wainwright',
                'rep' => 'Dirk Hudig',
            ),

            array(
                'id' => 138,
                'spad' => 'Rob Walton',
                'rep' => 'Laura Batchelor',
            ),

            array(
                'id' => 139,
                'spad' => 'Florus Wijsenbeek',
                'rep' => 'Peter-Carlo Lehrell',
            ),

            array(
                'id' => 140,
                'spad' => 'Catherine Bent',
                'rep' => 'Ann Kelly',
            ),

            array(
                'id' => 141,
                'spad' => 'Michael D’Arcy',
                'rep' => 'Ann Kelly',
            ),

            array(
                'id' => 142,
                'spad' => 'Allan Fels',
                'rep' => 'Phil Evans',
            ),

            array(
                'id' => 143,
                'spad' => 'Scott Hoeflich',
                'rep' => 'Rory Chisholm',
            ),

            array(
                'id' => 144,
                'spad' => 'Stephen Labaton',
                'rep' => 'Rory Chisholm',
            ),

            array(
                'id' => 145,
                'spad' => 'Bernard Merkel',
                'rep' => 'Laura Batchelor',
            ),

            array(
                'id' => 146,
                'spad' => 'Shan Ramburuth ',
                'rep' => 'Phil Evans',
            ),

        ));
        DB::table('unit_reps')->insert(array(
                    
            array(
                'id' => 262,
                'fipra_unit' => 'Fipra Australia',
                'rep' => 'Peter-Carlo Lehrell',
            ),

            array(
                'id' => 263,
                'fipra_unit' => 'Fipra Brazil',
                'rep' => 'Peter-Carlo Lehrell',
            ),

            array(
                'id' => 264,
                'fipra_unit' => 'Fipra Bulgaria',
                'rep' => 'David Lawsky',
            ),

            array(
                'id' => 265,
                'fipra_unit' => 'Fipra Canada',
                'rep' => 'Nathalie Hesketh',
            ),

            array(
                'id' => 266,
                'fipra_unit' => 'Fipra Croatia',
                'rep' => 'Peter-Carlo Lehrell',
            ),

            array(
                'id' => 267,
                'fipra_unit' => 'Fipra Czech Republic',
                'rep' => 'Sebastian Vos',
            ),

            array(
                'id' => 268,
                'fipra_unit' => 'Fipra Denmark',
                'rep' => 'Jan Ahlskog',
            ),

            array(
                'id' => 269,
                'fipra_unit' => 'Fipra Estonia',
                'rep' => 'Jan Ahlskog',
            ),

            array(
                'id' => 270,
                'fipra_unit' => 'Fipra Finland',
                'rep' => 'Jan Ahlskog',
            ),

            array(
                'id' => 271,
                'fipra_unit' => 'Fipra France',
                'rep' => 'Laura Batchelor',
            ),

            array(
                'id' => 272,
                'fipra_unit' => 'Fipra Germany',
                'rep' => 'Peter-Carlo Lehrell',
            ),

            array(
                'id' => 273,
                'fipra_unit' => 'Fipra Hungary',
                'rep' => 'Rory Chisholm',
            ),

            array(
                'id' => 274,
                'fipra_unit' => 'Fipra India',
                'rep' => 'Peter-Carlo Lehrell',
            ),

            array(
                'id' => 275,
                'fipra_unit' => 'Fipra Ireland',
                'rep' => 'Ann Kelly',
            ),

            array(
                'id' => 276,
                'fipra_unit' => 'Fipra Italy',
                'rep' => 'Peter-Carlo Lehrell',
            ),

            array(
                'id' => 277,
                'fipra_unit' => 'Fipra Japan',
                'rep' => 'Peter-Carlo Lehrell',
            ),

            array(
                'id' => 278,
                'fipra_unit' => 'Fipra South Korea',
                'rep' => 'David Lawsky',
            ),

            array(
                'id' => 279,
                'fipra_unit' => 'Fipra Latvia',
                'rep' => 'Jan Ahlskog',
            ),

            array(
                'id' => 280,
                'fipra_unit' => 'Fipra Lithuania',
                'rep' => 'Jan Ahlskog',
            ),

            array(
                'id' => 281,
                'fipra_unit' => 'Fipra Malta',
                'rep' => 'Ukko Metsola',
            ),

            array(
                'id' => 282,
                'fipra_unit' => 'Fipra Netherlands',
                'rep' => 'Sebastian Vos',
            ),

            array(
                'id' => 283,
                'fipra_unit' => 'Fipra Norway',
                'rep' => 'Jan Ahlskog',
            ),

            array(
                'id' => 284,
                'fipra_unit' => 'Fipra Poland',
                'rep' => 'Rory Chisholm',
            ),

            array(
                'id' => 285,
                'fipra_unit' => 'Fipra Portugal',
                'rep' => 'Laura Batchelor',
            ),

            array(
                'id' => 286,
                'fipra_unit' => 'Fipra Romania',
                'rep' => 'Rory Chisholm',
            ),

            array(
                'id' => 287,
                'fipra_unit' => 'Fipra Slovakia',
                'rep' => 'Sebastian Vos',
            ),

            array(
                'id' => 288,
                'fipra_unit' => 'Fipra Slovenia',
                'rep' => 'Peter-Carlo Lehrell',
            ),

            array(
                'id' => 289,
                'fipra_unit' => 'Fipra Spain',
                'rep' => 'Sebastian Vos',
            ),

            array(
                'id' => 290,
                'fipra_unit' => 'Fipra Sweden',
                'rep' => 'Jan Ahlskog',
            ),

            array(
                'id' => 291,
                'fipra_unit' => 'Fipra Switzerland',
                'rep' => 'Peter-Carlo Lehrell',
            ),

            array(
                'id' => 292,
                'fipra_unit' => 'Fipra Turkey',
                'rep' => 'Peter-Carlo Lehrell',
            ),

            array(
                'id' => 293,
                'fipra_unit' => 'Fipra Ukraine',
                'rep' => 'Dirk Hudig',
            ),

            array(
                'id' => 294,
                'fipra_unit' => 'Fipra United Kingdom',
                'rep' => 'Rory Chisholm',
            ),

            array(
                'id' => 295,
                'fipra_unit' => 'Belarus',
                'rep' => 'Peter-Carlo Lehrell',
            ),

            array(
                'id' => 296,
                'fipra_unit' => 'China',
                'rep' => 'Rory Chisholm',
            ),

            array(
                'id' => 297,
                'fipra_unit' => 'Columbia',
                'rep' => 'Peter-Carlo Lehrell',
            ),

            array(
                'id' => 298,
                'fipra_unit' => 'India',
                'rep' => 'Peter-Carlo Lehrell',
            ),

            array(
                'id' => 299,
                'fipra_unit' => 'Russia',
                'rep' => 'Peter-Carlo Lehrell',
            ),

            array(
                'id' => 300,
                'fipra_unit' => 'South Africa',
                'rep' => 'Sebastian Vos',
            ),

        ));DB::table('users')->insert(
                    
            array(
                'id' => 42,
                'email' => 'joanne.kelleher@fipra.com',
                'name' => 'Joanne Kelleher',
                'iwo_id' => 0,
                'created_at' => '2014-08-01 07:53:33',
                'updated_at' => '2014-08-01 07:53:34',
                'remember_token' => '',
            )

        );
    }
}