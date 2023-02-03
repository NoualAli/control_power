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
                'avatar' => '/images/avatars/default.png',
                'created_at' => '2022-12-11 21:55:55',
                'email' => 'noualdev@gmail.com',
                'first_name' => 'Ali',
                'id' => 1,
                'last_name' => 'Noual',
                'password' => '$2y$10$PbtJsEebDnXgN6J4M7OJ1.CrANtuealKrGa380AwrMS4Fp.ML.paq',
                'phone' => NULL,
                'remember_token' => NULL,

                'updated_at' => '2022-12-11 21:55:55',
                'username' => 'root',
            ),
            1 =>
            array(
                'avatar' => '/images/avatars/dcp.png',
                'created_at' => '2022-12-11 21:55:56',
                'email' => 'c.bechiri@power-control.com',
                'first_name' => 'Chiraz',
                'id' => 2,
                'last_name' => 'Bechiri',
                'password' => '$2y$10$hmVVGHDJVfZLrlrplfXW.ObfDvIlb581K3rdg8A6ra9aEKs5z4Eza',
                'phone' => NULL,
                'remember_token' => NULL,

                'updated_at' => '2023-01-12 09:58:47',
                'username' => 'DCP',
            ),
            2 =>
            array(
                'avatar' => '/images/avatars/drcp.png',
                'created_at' => '2022-12-11 21:55:56',
                'email' => 'f.naitslimane@power-control.com',
                'first_name' => 'Fazia',
                'id' => 3,
                'last_name' => 'Nait Slimane',
                'password' => '$2y$10$wzM74z7orcKHtAsKLoSdKO46Ifn88JPCCflCxlKZAZGW1suk2Zl0y',
                'phone' => NULL,
                'remember_token' => NULL,

                'updated_at' => '2022-12-11 21:55:56',
                'username' => 'drcp',
            ),
            3 =>
            array(
                'avatar' => '/images/avatars/2.png',
                'created_at' => '2022-12-11 21:55:56',
                'email' => 'a.akacha@power-control.com',
                'first_name' => 'Amina',
                'id' => 4,
                'last_name' => 'Akacha',
                'password' => '$2y$10$Ipe8N9JCCOD4vzb46V9AH.9VODpEIyXb5MV48ju3ZiNlUYyX6qeHa',
                'phone' => NULL,
                'remember_token' => NULL,

                'updated_at' => '2022-12-11 21:55:56',
                'username' => 'a.akacha',
            ),
            4 =>
            array(
                'avatar' => '/images/avatars/3.png',
                'created_at' => '2022-12-11 21:55:56',
                'email' => 'a.athmani@gmail.com',
                'first_name' => NULL,
                'id' => 5,
                'last_name' => NULL,
                'password' => '$2y$10$Q0KUoyZl67SNyGgOeZAH/.QE6R.o/MbZ3pbGpT5KIMRWzlyQB1vJy',
                'phone' => NULL,
                'remember_token' => NULL,

                'updated_at' => '2022-12-11 21:55:56',
                'username' => 'a.athmani',
            ),
            5 =>
            array(
                'avatar' => '/images/avatars/4.png',
                'created_at' => '2022-12-11 21:55:56',
                'email' => 'a.seddiki@gmail.com',
                'first_name' => NULL,
                'id' => 6,
                'last_name' => NULL,
                'password' => '$2y$10$EU37lNIzWrLmCKUT3nqNsO3ELDix9Nuaa0q1FyomD45WQWK9dmlVO',
                'phone' => NULL,
                'remember_token' => NULL,

                'updated_at' => '2023-01-13 19:54:47',
                'username' => 'A.SEDDIKI',
            ),
            6 =>
            array(
                'avatar' => '/images/avatars/dg.png',
                'created_at' => '2022-12-11 21:55:56',
                'email' => 'dg@power-control.com',
                'first_name' => 'Mohammed Lamine',
                'id' => 7,
                'last_name' => 'Lebbou',
                'password' => '$2y$10$5wb9B6UxOXHUEWTPukwn/Om8noya1tQU7pErcQtnuZH7PKHg5z0eS',
                'phone' => NULL,
                'remember_token' => NULL,

                'updated_at' => '2022-12-11 21:55:56',
                'username' => 'dg',
            ),
            7 =>
            array(
                'avatar' => '/images/avatars/5.png',
                'created_at' => '2022-12-11 21:55:56',
                'email' => 'd.benamane@power-control.com',
                'first_name' => NULL,
                'id' => 8,
                'last_name' => NULL,
                'password' => '$2y$10$vTfpQhQPQllsZsytE9ElN.7htrYgO7LGaGoIoKWny5SylWvMllsgK',
                'phone' => NULL,
                'remember_token' => NULL,

                'updated_at' => '2022-12-11 21:55:56',
                'username' => 'd.benamane',
            ),
            8 =>
            array(
                'avatar' => '/images/avatars/6.png',
                'created_at' => '2022-12-11 21:55:56',
                'email' => 'd.sellami@power-control.com',
                'first_name' => NULL,
                'id' => 9,
                'last_name' => NULL,
                'password' => '$2y$10$pGNI4vu8FPHiFHNqMNevNOklNDolqdF5pdQKn5X2xODlPLcLZVlnm',
                'phone' => NULL,
                'remember_token' => NULL,

                'updated_at' => '2022-12-11 21:55:56',
                'username' => 'd.sellami',
            ),
            9 =>
            array(
                'avatar' => '/images/avatars/7.png',
                'created_at' => '2022-12-12 17:39:04',
                'email' => 'cdc-garidi@power-control.com',
                'first_name' => NULL,
                'id' => 10,
                'last_name' => NULL,
                'password' => '$2y$10$XRBehzwvV1gzrwlmhBashuYrlvIbsKdIbF1eO4KOJp3ZJpVXj1ahW',
                'phone' => NULL,
                'remember_token' => NULL,

                'updated_at' => '2022-12-12 17:39:04',
                'username' => 'cdc-garidi',
            ),
            10 =>
            array(
                'avatar' => '/images/avatars/8.png',
                'created_at' => '2022-12-12 17:40:33',
                'email' => 'cdc-setif@power-control.com',
                'first_name' => NULL,
                'id' => 11,
                'last_name' => NULL,
                'password' => '$2y$10$4mNwANJWF2ut80ERE5i8C.nDHDywm4c5HkFR.zCJu/9WEp/xIijx.',
                'phone' => NULL,
                'remember_token' => NULL,

                'updated_at' => '2022-12-12 17:40:33',
                'username' => 'cdc-setif',
            ),
            11 =>
            array(
                'avatar' => '/images/avatars/9.png',
                'created_at' => '2022-12-12 17:41:21',
                'email' => 'cdc-rouiba@power-control.com',
                'first_name' => NULL,
                'id' => 12,
                'last_name' => NULL,
                'password' => '$2y$10$qLUEDm0/vgzBB.zhf8JqiembSRnEQI.mS7tfMCfsuYxzPWPmyFZ0a',
                'phone' => NULL,
                'remember_token' => NULL,

                'updated_at' => '2022-12-12 17:41:21',
                'username' => 'cdc-rouiba',
            ),
            12 =>
            array(
                'avatar' => '/images/avatars/10.png',
                'created_at' => '2022-12-12 17:41:53',
                'email' => 'cdc-mosta@power-control.com',
                'first_name' => NULL,
                'id' => 13,
                'last_name' => NULL,
                'password' => '$2y$10$EvQ9DjrrBryUDlXRrqGj8u2d9vTB.kVVlcXc2k3h9xRXlcva5ay.C',
                'phone' => NULL,
                'remember_token' => NULL,

                'updated_at' => '2022-12-12 17:41:53',
                'username' => 'cdc-mosta',
            ),
            13 =>
            array(
                'avatar' => '/images/avatars/11.png',
                'created_at' => '2022-12-12 17:42:25',
                'email' => 'ci-garidi@power-control.com',
                'first_name' => NULL,
                'id' => 14,
                'last_name' => NULL,
                'password' => '$2y$10$diS8pIGqfvzi/0pIJsdCTuXPFqFwDUp95C7PiwBiaaJKWoWDYvtKq',
                'phone' => NULL,
                'remember_token' => NULL,

                'updated_at' => '2022-12-12 17:42:25',
                'username' => 'ci-garidi',
            ),
            14 =>
            array(
                'avatar' => '/images/avatars/12.png',
                'created_at' => '2022-12-12 17:42:52',
                'email' => 'ci-setif@power-control.com',
                'first_name' => NULL,
                'id' => 15,
                'last_name' => NULL,
                'password' => '$2y$10$k540wynEdqBXY0zxXY3PE.9AYIsbt1yVSMAOp/KEnEDsm7VWOGQtK',
                'phone' => NULL,
                'remember_token' => NULL,

                'updated_at' => '2022-12-12 17:42:52',
                'username' => 'ci-setif',
            ),
            15 =>
            array(
                'avatar' => '/images/avatars/13.png',
                'created_at' => '2022-12-12 17:43:18',
                'email' => 'ci-rouiba@power-control.com',
                'first_name' => NULL,
                'id' => 16,
                'last_name' => NULL,
                'password' => '$2y$10$UdB.e0vrA7F9RdVujrCNoeK69zN2RfCS5J6du4o8eIA.EeOGTXg86',
                'phone' => NULL,
                'remember_token' => NULL,

                'updated_at' => '2022-12-12 17:43:18',
                'username' => 'ci-rouiba',
            ),
            16 =>
            array(
                'avatar' => '/images/avatars/14.png',
                'created_at' => '2022-12-12 17:43:42',
                'email' => 'ci-mosta@power-control.com',
                'first_name' => NULL,
                'id' => 17,
                'last_name' => NULL,
                'password' => '$2y$10$NZ5bVsYFhqukahUwPdCvauiPCz8U.0d9rLhMWq7OKv3D275huvSWm',
                'phone' => NULL,
                'remember_token' => NULL,

                'updated_at' => '2022-12-12 17:43:42',
                'username' => 'ci-mosta',
            ),
            17 =>
            array(
                'avatar' => '/images/avatars/15.png',
                'created_at' => '2022-12-19 17:24:50',
                'email' => 'cdc-bouzareah@power-control.com',
                'first_name' => NULL,
                'id' => 18,
                'last_name' => NULL,
                'password' => '$2y$10$J8cUJ7CPyrO3T2VK40iOC.jOndu5g5Jox6jjRDi/eGMTs/HY7umrW',
                'phone' => NULL,
                'remember_token' => NULL,

                'updated_at' => '2022-12-19 17:24:50',
                'username' => 'cdc-bouzareah',
            ),
            18 =>
            array(
                'avatar' => '/images/avatars/16.png',
                'created_at' => '2022-12-19 17:25:12',
                'email' => 'ci-bouzareah@power-control.com',
                'first_name' => NULL,
                'id' => 19,
                'last_name' => NULL,
                'password' => '$2y$10$YwzyA4AVwMJq.T6r8mTjku1beC2fm/qpJpsMMVd4g2R1creJNTw/u',
                'phone' => NULL,
                'remember_token' => NULL,

                'updated_at' => '2022-12-19 17:28:16',
                'username' => 'ci-bouzareah',
            ),
            19 =>
            array(
                'avatar' => '/images/avatars/17.png',
                'created_at' => '2022-12-19 17:26:16',
                'email' => 'cdc-elbiar@power-control.com',
                'first_name' => NULL,
                'id' => 20,
                'last_name' => NULL,
                'password' => '$2y$10$5WdmTZgS2mlygKUAa62TR.5f152o.a3uxirU9saWdEjF1tTCKSJsi',
                'phone' => NULL,
                'remember_token' => NULL,

                'updated_at' => '2022-12-19 17:26:16',
                'username' => 'cdc-elbiar',
            ),
            20 =>
            array(
                'avatar' => '/images/avatars/1.png',
                'created_at' => '2022-12-19 17:26:47',
                'email' => 'ci-elbiar@power-control.com',
                'first_name' => NULL,
                'id' => 21,
                'last_name' => NULL,
                'password' => '$2y$10$Dnsn5MS.Xi9lTLGCR1YVquk.uPLKXKmFwj0lxya6kbAgSzvRVvkca',
                'phone' => NULL,
                'remember_token' => NULL,

                'updated_at' => '2022-12-19 17:26:47',
                'username' => 'ci-elbiar',
            ),
            21 =>
            array(
                'avatar' => '/images/avatars/default.png',
                'created_at' => '2023-01-20 12:20:45',
                'email' => 'benmadizakarya@gmail.com',
                'first_name' => 'Zakarya',
                'id' => 22,
                'last_name' => 'Benmadi',
                'password' => '$2y$10$sJ25a7htX6NdB31Z/gpLZOKxXpaLK3Kz6cDdCIhGAVpfPGcvInSHy',
                'phone' => NULL,
                'remember_token' => NULL,

                'updated_at' => '2023-01-20 12:21:46',
                'username' => 'z.benmadi',
            ),
        ));
    }
}