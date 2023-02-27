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
        
        \DB::table('users')->insert(array (
            0 => 
            array (
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
            array (
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
            array (
                'avatar' => '/images/avatars/drcp.png',
                'created_at' => '2022-12-11 21:55:56',
                'email' => 'f.naitslimane@power-control.com',
                'first_name' => 'Fazia',
                'id' => 3,
                'last_name' => 'Nait Slimane',
                'password' => '$2y$10$wzM74z7orcKHtAsKLoSdKO46Ifn88JPCCflCxlKZAZGW1suk2Zl0y',
                'phone' => NULL,
                'remember_token' => NULL,
                'updated_at' => '2023-02-14 16:56:58',
                'username' => 'DRCP',
            ),
            3 => 
            array (
                'avatar' => '/images/avatars/dg.png',
                'created_at' => '2022-12-11 21:55:56',
                'email' => 'dg@power-control.com',
                'first_name' => 'Mohammed Lamine',
                'id' => 4,
                'last_name' => 'Lebbou',
                'password' => '$2y$10$5wb9B6UxOXHUEWTPukwn/Om8noya1tQU7pErcQtnuZH7PKHg5z0eS',
                'phone' => NULL,
                'remember_token' => NULL,
                'updated_at' => '2022-12-11 21:55:56',
                'username' => 'dg',
            ),
            4 => 
            array (
                'avatar' => '/images/avatars/7.png',
                'created_at' => '2022-12-12 17:39:04',
                'email' => 'cdc-garidi@power-control.com',
                'first_name' => NULL,
                'id' => 5,
                'last_name' => NULL,
                'password' => '$2y$10$XRBehzwvV1gzrwlmhBashuYrlvIbsKdIbF1eO4KOJp3ZJpVXj1ahW',
                'phone' => NULL,
                'remember_token' => NULL,
                'updated_at' => '2022-12-12 17:39:04',
                'username' => 'cdc-garidi',
            ),
            5 => 
            array (
                'avatar' => '/images/avatars/8.png',
                'created_at' => '2022-12-12 17:40:33',
                'email' => 'cdc-setif@power-control.com',
                'first_name' => NULL,
                'id' => 6,
                'last_name' => NULL,
                'password' => '$2y$10$4mNwANJWF2ut80ERE5i8C.nDHDywm4c5HkFR.zCJu/9WEp/xIijx.',
                'phone' => NULL,
                'remember_token' => NULL,
                'updated_at' => '2022-12-12 17:40:33',
                'username' => 'cdc-setif',
            ),
            6 => 
            array (
                'avatar' => '/images/avatars/9.png',
                'created_at' => '2022-12-12 17:41:21',
                'email' => 'cdc-rouiba@power-control.com',
                'first_name' => NULL,
                'id' => 7,
                'last_name' => NULL,
                'password' => '$2y$10$qLUEDm0/vgzBB.zhf8JqiembSRnEQI.mS7tfMCfsuYxzPWPmyFZ0a',
                'phone' => NULL,
                'remember_token' => NULL,
                'updated_at' => '2022-12-12 17:41:21',
                'username' => 'cdc-rouiba',
            ),
            7 => 
            array (
                'avatar' => '/images/avatars/10.png',
                'created_at' => '2022-12-12 17:41:53',
                'email' => 'cdc-mosta@power-control.com',
                'first_name' => NULL,
                'id' => 8,
                'last_name' => NULL,
                'password' => '$2y$10$EvQ9DjrrBryUDlXRrqGj8u2d9vTB.kVVlcXc2k3h9xRXlcva5ay.C',
                'phone' => NULL,
                'remember_token' => NULL,
                'updated_at' => '2022-12-12 17:41:53',
                'username' => 'cdc-mosta',
            ),
            8 => 
            array (
                'avatar' => '/images/avatars/11.png',
                'created_at' => '2022-12-12 17:42:25',
                'email' => 'ci-garidi@power-control.com',
                'first_name' => NULL,
                'id' => 9,
                'last_name' => NULL,
                'password' => '$2y$10$diS8pIGqfvzi/0pIJsdCTuXPFqFwDUp95C7PiwBiaaJKWoWDYvtKq',
                'phone' => NULL,
                'remember_token' => NULL,
                'updated_at' => '2022-12-12 17:42:25',
                'username' => 'ci-garidi',
            ),
            9 => 
            array (
                'avatar' => '/images/avatars/12.png',
                'created_at' => '2022-12-12 17:42:52',
                'email' => 'ci-setif@power-control.com',
                'first_name' => NULL,
                'id' => 10,
                'last_name' => NULL,
                'password' => '$2y$10$k540wynEdqBXY0zxXY3PE.9AYIsbt1yVSMAOp/KEnEDsm7VWOGQtK',
                'phone' => NULL,
                'remember_token' => NULL,
                'updated_at' => '2022-12-12 17:42:52',
                'username' => 'ci-setif',
            ),
            10 => 
            array (
                'avatar' => '/images/avatars/13.png',
                'created_at' => '2022-12-12 17:43:18',
                'email' => 'ci-rouiba@power-control.com',
                'first_name' => NULL,
                'id' => 11,
                'last_name' => NULL,
                'password' => '$2y$10$UdB.e0vrA7F9RdVujrCNoeK69zN2RfCS5J6du4o8eIA.EeOGTXg86',
                'phone' => NULL,
                'remember_token' => NULL,
                'updated_at' => '2022-12-12 17:43:18',
                'username' => 'ci-rouiba',
            ),
            11 => 
            array (
                'avatar' => '/images/avatars/14.png',
                'created_at' => '2022-12-12 17:43:42',
                'email' => 'ci-mosta@power-control.com',
                'first_name' => NULL,
                'id' => 12,
                'last_name' => NULL,
                'password' => '$2y$10$NZ5bVsYFhqukahUwPdCvauiPCz8U.0d9rLhMWq7OKv3D275huvSWm',
                'phone' => NULL,
                'remember_token' => NULL,
                'updated_at' => '2022-12-12 17:43:42',
                'username' => 'ci-mosta',
            ),
            12 => 
            array (
                'avatar' => '/images/avatars/15.png',
                'created_at' => '2022-12-19 17:24:50',
                'email' => 'cdc-bouzareah@power-control.com',
                'first_name' => NULL,
                'id' => 13,
                'last_name' => NULL,
                'password' => '$2y$10$J8cUJ7CPyrO3T2VK40iOC.jOndu5g5Jox6jjRDi/eGMTs/HY7umrW',
                'phone' => NULL,
                'remember_token' => NULL,
                'updated_at' => '2022-12-19 17:24:50',
                'username' => 'cdc-bouzareah',
            ),
            13 => 
            array (
                'avatar' => '/images/avatars/16.png',
                'created_at' => '2022-12-19 17:25:12',
                'email' => 'ci-bouzareah@power-control.com',
                'first_name' => NULL,
                'id' => 14,
                'last_name' => NULL,
                'password' => '$2y$10$YwzyA4AVwMJq.T6r8mTjku1beC2fm/qpJpsMMVd4g2R1creJNTw/u',
                'phone' => NULL,
                'remember_token' => NULL,
                'updated_at' => '2022-12-19 17:28:16',
                'username' => 'ci-bouzareah',
            ),
            14 => 
            array (
                'avatar' => '/images/avatars/17.png',
                'created_at' => '2022-12-19 17:26:16',
                'email' => 'cdc-elbiar@power-control.com',
                'first_name' => NULL,
                'id' => 15,
                'last_name' => NULL,
                'password' => '$2y$10$5WdmTZgS2mlygKUAa62TR.5f152o.a3uxirU9saWdEjF1tTCKSJsi',
                'phone' => NULL,
                'remember_token' => NULL,
                'updated_at' => '2022-12-19 17:26:16',
                'username' => 'cdc-elbiar',
            ),
            15 => 
            array (
                'avatar' => '/images/avatars/1.png',
                'created_at' => '2022-12-19 17:26:47',
                'email' => 'ci-elbiar@power-control.com',
                'first_name' => NULL,
                'id' => 16,
                'last_name' => NULL,
                'password' => '$2y$10$Dnsn5MS.Xi9lTLGCR1YVquk.uPLKXKmFwj0lxya6kbAgSzvRVvkca',
                'phone' => NULL,
                'remember_token' => NULL,
                'updated_at' => '2022-12-19 17:26:47',
                'username' => 'ci-elbiar',
            ),
            16 => 
            array (
                'avatar' => '/images/avatars/default.png',
                'created_at' => '2023-01-20 12:20:45',
                'email' => 'benmadizakarya@gmail.com',
                'first_name' => 'Zakarya',
                'id' => 17,
                'last_name' => 'Benmadi',
                'password' => '$2y$10$sJ25a7htX6NdB31Z/gpLZOKxXpaLK3Kz6cDdCIhGAVpfPGcvInSHy',
                'phone' => NULL,
                'remember_token' => NULL,
                'updated_at' => '2023-01-20 12:21:46',
                'username' => 'z.benmadi',
            ),
            17 => 
            array (
                'avatar' => '/images/avatars/default.png',
                'created_at' => '2023-02-14 17:40:05',
                'email' => 'cdcr@bna.dz',
                'first_name' => NULL,
                'id' => 18,
                'last_name' => NULL,
                'password' => '$2y$10$hBqDWmqCL/DepvW6woG18eSBlDHuGROkDbjDg9WF5j2ie899DNNiy',
                'phone' => NULL,
                'remember_token' => NULL,
                'updated_at' => '2023-02-14 17:40:05',
                'username' => 'cdcr',
            ),
            18 => 
            array (
                'avatar' => '/images/avatars/default.png',
                'created_at' => '2023-02-14 17:41:07',
                'email' => 'm.touahri@bna.dz',
                'first_name' => 'Mohamed',
                'id' => 19,
                'last_name' => 'Touahri',
                'password' => '$2y$10$SlKVL57xBzZO3djTHlhNjeG1fSxKKYCKlVMLvV1MY5.pvt6qowi4i',
                'phone' => NULL,
                'remember_token' => NULL,
                'updated_at' => '2023-02-14 23:39:48',
                'username' => 'm.touahri',
            ),
            19 => 
            array (
                'avatar' => '/images/avatars/default.png',
                'created_at' => '2023-02-17 23:51:49',
                'email' => 'ig@bna.dz',
                'first_name' => NULL,
                'id' => 20,
                'last_name' => NULL,
                'password' => '$2y$10$7qZ6K4vKcWOb3HEnfdQwpuywthKjY9eFg/bPNQ92J2dyZ3UBVDIe.',
                'phone' => NULL,
                'remember_token' => NULL,
                'updated_at' => '2023-02-18 13:40:16',
                'username' => 'IG',
            ),
            20 => 
            array (
                'avatar' => '/images/avatars/default.png',
                'created_at' => '2023-02-19 20:23:40',
                'email' => 'radiabnabdesselam1998@gmail.com',
                'first_name' => 'Radia',
                'id' => 22,
                'last_name' => 'Benabdsselam',
                'password' => '$2y$10$2UDIef3Z10zQ/2xHREW5j.A7xpLdym/q2N5abvvOBGcJv/I25naDC',
                'phone' => NULL,
                'remember_token' => NULL,
                'updated_at' => '2023-02-19 20:23:40',
                'username' => 'b.radia',
            ),
            21 => 
            array (
                'avatar' => '/images/avatars/default.png',
                'created_at' => '2023-02-19 20:53:19',
                'email' => 'mumuste.mend@gmail.com',
                'first_name' => 'Mustapha',
                'id' => 23,
                'last_name' => 'Mendil',
                'password' => '$2y$10$jfcjYfSXNI6CgQFg6YSVWujNVfRFKDRV4m/b0OkZn1iPh0qzgBHbG',
                'phone' => NULL,
                'remember_token' => NULL,
                'updated_at' => '2023-02-19 20:53:19',
                'username' => 'm.mustapha',
            ),
            22 => 
            array (
                'avatar' => '/images/avatars/default.png',
                'created_at' => '2023-02-20 21:59:04',
                'email' => 'da-dar-el-beida@bna.dz',
                'first_name' => NULL,
                'id' => 24,
                'last_name' => NULL,
                'password' => '$2y$10$bryL5BDx/A82sqIWgfVPc.oGgozTl6ODkPaOGIKO4jLgIbad3K3PG',
                'phone' => NULL,
                'remember_token' => NULL,
                'updated_at' => '2023-02-21 11:25:28',
                'username' => 'DA-DAR-EL-BEIDA',
            ),
            23 => 
            array (
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