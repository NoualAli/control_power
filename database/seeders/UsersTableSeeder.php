<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('users')->delete();

        \DB::table('users')->insert(array(
            0 =>
            array(
                'id' => '1',
                'username' => 'root',
                'first_name' => 'Ali',
                'last_name' => 'Noual',
                'password' => '$2y$10$PbtJsEebDnXgN6J4M7OJ1.CrANtuealKrGa380AwrMS4Fp.ML.paq',
                'remember_token' => NULL,
                'created_at' => '2022-12-11 21:55:55.0000000',
                'updated_at' => '2023-04-11 22:18:05.1360000',
                'must_change_password' => '0',
            ),
            1 =>
            array(
                'id' => '2',
                'username' => 'DCP',
                'first_name' => 'Chiraz',
                'last_name' => 'Bechiri',
                'email' => 'DCPermanant@bna.dz',
                'phone' => NULL,
                'remember_token' => NULL,
                'created_at' => '2022-12-11 21:55:56.0000000',
                'updated_at' => '2023-04-16 14:26:33.4360000',
                'must_change_password' => '0',
            ),
            2 =>
            array(
                'id' => '3',
                'username' => 'CDRCP',
                'first_name' => 'Fazia',
                'last_name' => 'Nait Slimane',
                'email' => 'DRCP@bna.dz',
                'phone' => NULL,
                'remember_token' => NULL,
                'created_at' => '2022-12-11 21:55:56.0000000',
                'updated_at' => '2023-05-27 21:59:35.8020000',
                'must_change_password' => '0',
            ),
            3 =>
            array(
                'id' => '4',
                'username' => 'DG',
                'first_name' => 'Mohammed Lamine',
                'last_name' => 'Lebbou',
                'email' => 'dg@bna.dz',
                'phone' => NULL,
                'remember_token' => NULL,
                'created_at' => '2022-12-11 21:55:56.0000000',
                'updated_at' => '2023-04-19 11:30:49.6360000',
                'must_change_password' => '0',
            ),
            4 =>
            array(
                'id' => '17',
                'username' => 'z.benmadi',
                'first_name' => 'Zakarya',
                'last_name' => 'Benmadi',
                'email' => 'z.benmadi@gmail.com',
                'phone' => NULL,
                'remember_token' => NULL,
                'created_at' => '2023-01-20 12:20:45.0000000',
                'updated_at' => '2023-04-11 21:51:58.6780000',
                'must_change_password' => '0',
            ),
            5 =>
            array(
                'id' => '19',
                'username' => 'm.touahri',
                'first_name' => 'Mohamed',
                'last_name' => 'Touahri',
                'email' => 'moh.touahri@bna.dz',
                'phone' => NULL,
                'remember_token' => NULL,
                'created_at' => '2023-02-14 17:41:07.0000000',
                'updated_at' => '2023-05-26 17:29:00.8360000',
                'must_change_password' => '0',
            ),
            6 =>
            array(
                'id' => '20',
                'username' => 'IG',
                'first_name' => NULL,
                'last_name' => NULL,
                'email' => 'ig@bna.dz',
                'email' => 'ig@bna.dz',
                'phone' => NULL,
                'remember_token' => NULL,
                'updated_at' => '2022-12-12 17:41:21',
                'username' => 'cdc-rouiba',
            ),
            7 =>
            array(
                'id' => '23',
                'username' => 'm.mustapha',
                'first_name' => 'Mustapha',
                'last_name' => 'Mendil',
                'email' => 'mumuste.mend@gmail.com',
                'phone' => NULL,
                'remember_token' => NULL,
                'updated_at' => '2022-12-12 17:41:53',
                'username' => 'cdc-mosta',
            ),
            8 =>
            array(
                'id' => '25',
                'username' => 'DER',
                'first_name' => NULL,
                'last_name' => NULL,
                'email' => 'der@gmail.com',
                'email' => 'der@gmail.com',
                'phone' => NULL,
                'remember_token' => NULL,
                'updated_at' => '2022-12-12 17:42:25',
                'username' => 'ci-garidi',
            ),
            9 =>
            array(
                'id' => '26',
                'username' => 'h.belloundja',
                'first_name' => 'Hassiba',
                'last_name' => 'Belloundja',
                'email' => 'h.belloundja@bna.dz',
                'phone' => NULL,
                'remember_token' => NULL,
                'updated_at' => '2022-12-12 17:42:52',
                'username' => 'ci-setif',
            ),
            10 =>
            array(
                'id' => '27',
                'username' => 'a.adjaoud',
                'first_name' => 'Abdelhadi',
                'last_name' => 'Adjaoud',
                'email' => 'a.adjaoud@bna.dz',
                'phone' => NULL,
                'remember_token' => NULL,
                'updated_at' => '2022-12-12 17:43:18',
                'username' => 'ci-rouiba',
            ),
            11 =>
            array(
                'id' => '38',
                'username' => '747',
                'first_name' => 'Malika',
                'last_name' => 'Maldji',
                'email' => 'DRE187controle@bna.dz',
                'phone' => '0540602924',
                'avatar' => NULL,
                'password' => '$2y$10$n7UYf.0YzoWL.l.iq5SZGuyfgoXoIuZSj0Kh51PMMiHuaU3ML8LLO',
                'remember_token' => NULL,
                'updated_at' => '2022-12-12 17:43:42',
                'username' => 'ci-mosta',
            ),
            12 =>
            array(
                'id' => '39',
                'username' => '6969',
                'first_name' => 'Djellali',
                'last_name' => 'Siham',
                'email' => 's.djellali@bna.dz',
                'phone' => '0555531013',
                'avatar' => NULL,
                'password' => '$2y$10$npj07Hc.dDGCuUKqaJKJ1uo1jEPhdI.ildv.Y8saOsLhGYQQ7j8ym',
                'remember_token' => NULL,
                'updated_at' => '2022-12-19 17:24:50',
                'username' => 'cdc-bouzareah',
            ),
            13 =>
            array(
                'id' => '40',
                'username' => '362',
                'first_name' => 'Soumia',
                'last_name' => 'Merghit',
                'email' => 's.merghit@bna.dz',
                'phone' => '0696641162',
                'avatar' => NULL,
                'password' => '$2y$10$rbnm2CFxYJfFJqHOsUOzhOeJHtpfdjvZfo5keS7vbdeb9/f5wJuiy',
                'remember_token' => NULL,
                'updated_at' => '2022-12-19 17:28:16',
                'username' => 'ci-bouzareah',
            ),
            14 =>
            array(
                'id' => '41',
                'username' => '13057',
                'first_name' => 'Farid',
                'last_name' => 'Kheyar',
                'email' => 'f.kheyar@bna.dz',
                'phone' => '0550261370',
                'avatar' => NULL,
                'password' => '$2y$10$WTIWBPb.MiXaOVkdrH/nV.AuzAdvUaiNoAXschVM5Ziaiu0EEms6y',
                'remember_token' => NULL,
                'updated_at' => '2022-12-19 17:26:16',
                'username' => 'cdc-elbiar',
            ),
            15 =>
            array(
                'id' => '44',
                'username' => 'cdc-garidi',
                'first_name' => NULL,
                'last_name' => NULL,
                'email' => 'cdc-garidi@bna.dz',
                'email' => 'cdc-garidi@bna.dz',
                'phone' => NULL,
                'remember_token' => NULL,
                'updated_at' => '2022-12-19 17:26:47',
                'username' => 'ci-elbiar',
            ),
            16 =>
            array(
                'id' => '45',
                'username' => 'ci-garidi',
                'first_name' => NULL,
                'last_name' => NULL,
                'email' => 'ci-garidi@bna.dz',
                'phone' => NULL,
                'remember_token' => NULL,
                'updated_at' => '2023-01-20 12:21:46',
                'username' => 'z.benmadi',
            ),
            17 =>
            array(
                'id' => '46',
                'username' => 'da-633',
                'first_name' => NULL,
                'last_name' => NULL,
                'email' => 'da-633@bna.dz',
                'email' => 'da-633@bna.dz',
                'phone' => NULL,
                'remember_token' => NULL,
                'updated_at' => '2023-02-14 17:40:05',
                'username' => 'cdcr',
            ),
            18 =>
            array(
                'id' => '47',
                'username' => 'cdcr',
                'first_name' => NULL,
                'last_name' => NULL,
                'email' => 'cdcr@dev.dz',
                'phone' => NULL,
                'remember_token' => NULL,
                'updated_at' => '2023-02-14 23:39:48',
                'username' => 'm.touahri',
            ),
            19 =>
            array(
                'id' => '48',
                'username' => 'dre-garidi',
                'first_name' => NULL,
                'last_name' => NULL,
                'email' => 'dre-garidi@dev.dz',
                'email' => 'dre-garidi@dev.dz',
                'phone' => NULL,
                'remember_token' => NULL,
                'updated_at' => '2023-02-18 13:40:16',
                'username' => 'IG',
            ),
            20 =>
            array(
                'id' => '49',
                'username' => 'dre-bouzareah',
                'first_name' => NULL,
                'last_name' => NULL,
                'email' => 'dre-bouzareah@bna.dz',
                'phone' => NULL,
                'remember_token' => NULL,
                'updated_at' => '2023-02-19 20:23:40',
                'username' => 'b.radia',
            ),
            21 =>
            array(
                'id' => '50',
                'username' => 'DRE-EL-BIAR',
                'first_name' => NULL,
                'last_name' => NULL,
                'email' => 'DRE-EL-BIAR@bna.dz',
                'phone' => NULL,
                'remember_token' => NULL,
                'updated_at' => '2023-02-19 20:53:19',
                'username' => 'm.mustapha',
            ),
            22 =>
            array(
                'id' => '51',
                'username' => 'DRE-KOLEA',
                'first_name' => NULL,
                'last_name' => NULL,
                'email' => 'DRE-KOLEA@bna.dz',
                'email' => 'DRE-KOLEA@bna.dz',
                'phone' => NULL,
                'remember_token' => NULL,
                'updated_at' => '2023-02-21 11:25:28',
                'username' => 'DA-DAR-EL-BEIDA',
            ),
            23 =>
            array(
                'avatar' => '/images/avatars/default.png',
                'created_at' => '2023-02-23 10:58:19',
                'email' => 'der@gmail.com',
                'first_name' => 'der',
                'id' => 25,
                'last_name' => 'der',
                'password' => '$2y$10$WcByaHsS8zAR6nucIpNbxug2vmgBIDbqlnJjTTpYSpHFFlpMA/6My',
                'phone' => NULL,
                'remember_token' => NULL,
                'updated_at' => '2023-02-23 10:58:19',
                'username' => 'der',
            ),
        ));
    }
}
