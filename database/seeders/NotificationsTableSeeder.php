<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NotificationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('notifications')->delete();
        
        \DB::table('notifications')->insert(array (
            0 => 
            array (
                'id' => '04c91677-3033-4b71-b327-50d07f7996ef',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 3,
                'data' => '{"id":"25222f9d-cd36-4b05-8877-b4d2b1e0aa6b","url":"\\/missions\\/25222f9d-cd36-4b05-8877-b4d2b1e0aa6b\\/details\\/25","content":"Un fait majeur vient d\'\\u00eatre d\\u00e9tecter dans la mission 202302\\/612","title":"Fait majeur d\\u00e9tecter"}',
                'read_at' => NULL,
                'created_at' => '2023-02-15 15:01:28',
                'updated_at' => '2023-02-15 15:01:28',
            ),
            1 => 
            array (
                'id' => '19cc8265-03dd-41bc-8228-55a1f1bd8c97',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 2,
                'data' => '{"id":"25222f9d-cd36-4b05-8877-b4d2b1e0aa6b","url":"\\/missions\\/25222f9d-cd36-4b05-8877-b4d2b1e0aa6b\\/details\\/25","content":"Un fait majeur vient d\'\\u00eatre d\\u00e9tecter dans la mission 202302\\/612","title":"Fait majeur d\\u00e9tecter"}',
                'read_at' => NULL,
                'created_at' => '2023-02-15 16:31:03',
                'updated_at' => '2023-02-15 16:31:03',
            ),
            2 => 
            array (
                'id' => '1d35bed2-26cc-48cd-aa8e-734dca8237c9',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 2,
                'data' => '{"id":"25222f9d-cd36-4b05-8877-b4d2b1e0aa6b","url":"\\/missions\\/25222f9d-cd36-4b05-8877-b4d2b1e0aa6b\\/details\\/25","content":"Un fait majeur vient d\'\\u00eatre d\\u00e9tecter dans la mission 202302\\/612","title":"Fait majeur d\\u00e9tecter","detail_id":"4e0f01fd-f8b1-42f4-b927-e52179beaf35"}',
                'read_at' => NULL,
                'created_at' => '2023-02-15 16:42:42',
                'updated_at' => '2023-02-15 16:42:42',
            ),
            3 => 
            array (
                'id' => '1f177036-0b36-4087-9453-aeea1859d4b6',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 3,
                'data' => '{"id":"25222f9d-cd36-4b05-8877-b4d2b1e0aa6b","url":"\\/missions\\/25222f9d-cd36-4b05-8877-b4d2b1e0aa6b\\/details\\/25","content":"Un fait majeur vient d\'\\u00eatre d\\u00e9tecter dans la mission 202302\\/612","title":"Fait majeur d\\u00e9tecter"}',
                'read_at' => NULL,
                'created_at' => '2023-02-15 16:31:04',
                'updated_at' => '2023-02-15 16:31:04',
            ),
            4 => 
            array (
                'id' => '392b1d06-60e2-4ae7-8208-ed0957feb930',
                'type' => 'App\\Notifications\\MissionDetailRegularized',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 2,
                'data' => '{"id":"25222f9d-cd36-4b05-8877-b4d2b1e0aa6b","url":"http:\\/\\/127.0.0.1:8000\\/missions\\/25222f9d-cd36-4b05-8877-b4d2b1e0aa6b","content":"La mission avec la r\\u00e9f\\u00e9rence 202302\\/612 qui concerne l\'agence 612 - Agence DAR EL BEIDA vous a \\u00e9t\\u00e9 assign\\u00e9.","title":"Mission assign\\u00e9e"}',
                'read_at' => NULL,
                'created_at' => '2023-02-20 22:34:56',
                'updated_at' => '2023-02-20 22:34:56',
            ),
            5 => 
            array (
                'id' => '3d736d8b-b944-41e6-ae25-c9712f9b11e7',
                'type' => 'App\\Notifications\\MissionValidatedNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 4,
                'data' => '{"id":"25222f9d-cd36-4b05-8877-b4d2b1e0aa6b","className":"App\\\\Models\\\\Mission","routeName":"mission","paramNames":"missionId","content":"La mission de contr\\u00f4le 202302\\/612 vient d\'\\u00eatre valid\\u00e9e","title":"Mission valid\\u00e9e"}',
                'read_at' => NULL,
                'created_at' => '2023-02-18 21:37:25',
                'updated_at' => '2023-02-18 21:37:25',
            ),
            6 => 
            array (
                'id' => '3f57c1ff-97e2-49b2-a454-48da3b3b8e37',
                'type' => 'App\\Notifications\\MissionValidatedNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 18,
                'data' => '{"id":"25222f9d-cd36-4b05-8877-b4d2b1e0aa6b","className":"App\\\\Models\\\\Mission","routeName":"mission","paramNames":"missionId","content":"La mission de contr\\u00f4le 202302\\/612 vient d\'\\u00eatre valid\\u00e9e","title":"Mission valid\\u00e9e"}',
                'read_at' => NULL,
                'created_at' => '2023-02-18 21:32:22',
                'updated_at' => '2023-02-18 21:32:22',
            ),
            7 => 
            array (
                'id' => '44961fbc-487f-4756-bd69-fe755ecc03ea',
                'type' => 'App\\Notifications\\MissionValidatedNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 2,
                'data' => '{"id":"25222f9d-cd36-4b05-8877-b4d2b1e0aa6b","className":"App\\\\Models\\\\Mission","routeName":"mission","paramNames":"missionId","content":"La mission de contr\\u00f4le 202302\\/612 vient d\'\\u00eatre valid\\u00e9e","title":"Mission valid\\u00e9e"}',
                'read_at' => NULL,
                'created_at' => '2023-02-18 21:35:29',
                'updated_at' => '2023-02-18 21:35:29',
            ),
            8 => 
            array (
                'id' => '4c2b14b1-fea3-431d-8249-66495c358636',
                'type' => 'App\\Notifications\\MissionValidatedNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 4,
                'data' => '{"id":"25222f9d-cd36-4b05-8877-b4d2b1e0aa6b","className":"App\\\\Models\\\\Mission","routeName":"mission","paramNames":"missionId","content":"La mission de contr\\u00f4le 202302\\/612 vient d\'\\u00eatre valid\\u00e9e","title":"Mission valid\\u00e9e"}',
                'read_at' => NULL,
                'created_at' => '2023-02-18 21:05:04',
                'updated_at' => '2023-02-18 21:05:04',
            ),
            9 => 
            array (
                'id' => '4eb625dc-03a1-4ce8-91bc-de621330ab3c',
                'type' => 'App\\Notifications\\MissionValidatedNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 19,
                'data' => '{"id":"25222f9d-cd36-4b05-8877-b4d2b1e0aa6b","className":"App\\\\Models\\\\Mission","routeName":"mission","paramNames":"missionId","content":"La mission de contr\\u00f4le 202302\\/612 vient d\'\\u00eatre valid\\u00e9e","title":"Mission valid\\u00e9e"}',
                'read_at' => NULL,
                'created_at' => '2023-02-15 13:12:43',
                'updated_at' => '2023-02-15 13:12:43',
            ),
            10 => 
            array (
                'id' => '4f9b7e1b-b526-433c-9b6c-6dd04549b5f7',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 2,
                'data' => '{"id":"25222f9d-cd36-4b05-8877-b4d2b1e0aa6b","url":"\\/missions\\/25222f9d-cd36-4b05-8877-b4d2b1e0aa6b\\/details\\/25","content":"Un fait majeur vient d\'\\u00eatre d\\u00e9tecter dans la mission 202302\\/612","title":"Fait majeur d\\u00e9tecter"}',
                'read_at' => NULL,
                'created_at' => '2023-02-15 16:23:30',
                'updated_at' => '2023-02-15 16:23:30',
            ),
            11 => 
            array (
                'id' => '6876edb0-b76d-40e6-bcd2-0b5de13d94a9',
                'type' => 'App\\Notifications\\MissionValidatedNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 5,
                'data' => '{"id":"25222f9d-cd36-4b05-8877-b4d2b1e0aa6b","className":"App\\\\Models\\\\Mission","routeName":"mission","paramNames":"missionId","content":"La mission de contr\\u00f4le 202302\\/612 vient d\'\\u00eatre valid\\u00e9e","title":"Mission valid\\u00e9e"}',
                'read_at' => NULL,
                'created_at' => '2023-02-15 12:57:31',
                'updated_at' => '2023-02-15 12:57:31',
            ),
            12 => 
            array (
                'id' => '6cd852d5-ee3b-4745-ab8f-a51f65ec4395',
                'type' => 'App\\Notifications\\MissionValidatedNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 18,
                'data' => '{"id":"25222f9d-cd36-4b05-8877-b4d2b1e0aa6b","className":"App\\\\Models\\\\Mission","routeName":"mission","paramNames":"missionId","content":"La mission de contr\\u00f4le 202302\\/612 vient d\'\\u00eatre valid\\u00e9e","title":"Mission valid\\u00e9e"}',
                'read_at' => NULL,
                'created_at' => '2023-02-18 21:05:04',
                'updated_at' => '2023-02-18 21:05:04',
            ),
            13 => 
            array (
                'id' => '707d1910-1925-4a02-a702-a60cc17876cd',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 3,
                'data' => '{"id":"25222f9d-cd36-4b05-8877-b4d2b1e0aa6b","url":"\\/missions\\/25222f9d-cd36-4b05-8877-b4d2b1e0aa6b\\/details\\/25","content":"Un fait majeur vient d\'\\u00eatre d\\u00e9tecter dans la mission 202302\\/612","title":"Fait majeur d\\u00e9tecter","detail_id":"4e0f01fd-f8b1-42f4-b927-e52179beaf35"}',
                'read_at' => NULL,
                'created_at' => '2023-02-15 16:42:43',
                'updated_at' => '2023-02-15 16:42:43',
            ),
            14 => 
            array (
                'id' => '725f270b-0742-44d7-b1b6-24d87d34ac48',
                'type' => 'App\\Notifications\\MissionValidatedNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 2,
                'data' => '{"id":"25222f9d-cd36-4b05-8877-b4d2b1e0aa6b","className":"App\\\\Models\\\\Mission","routeName":"mission","paramNames":"missionId","content":"La mission de contr\\u00f4le 202302\\/612 vient d\'\\u00eatre valid\\u00e9e","title":"Mission valid\\u00e9e"}',
                'read_at' => NULL,
                'created_at' => '2023-02-18 21:03:27',
                'updated_at' => '2023-02-18 21:03:27',
            ),
            15 => 
            array (
                'id' => '7fa95727-fc98-4563-aa34-825d861fb936',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 4,
                'data' => '{"id":"25222f9d-cd36-4b05-8877-b4d2b1e0aa6b","url":"\\/missions\\/25222f9d-cd36-4b05-8877-b4d2b1e0aa6b\\/details\\/25","content":"Un fait majeur vient d\'\\u00eatre d\\u00e9tecter dans la mission 202302\\/612","title":"Fait majeur d\\u00e9tecter"}',
                'read_at' => NULL,
                'created_at' => '2023-02-15 16:31:03',
                'updated_at' => '2023-02-15 16:31:03',
            ),
            16 => 
            array (
                'id' => '802217b6-e1d8-4ad3-bcc3-a84d27acf877',
                'type' => 'App\\Notifications\\MissionDetailRegularized',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 2,
                'data' => '{"id":"25222f9d-cd36-4b05-8877-b4d2b1e0aa6b","url":"http:\\/\\/127.0.0.1:8000\\/missions\\/25222f9d-cd36-4b05-8877-b4d2b1e0aa6b","content":"La mission avec la r\\u00e9f\\u00e9rence 202302\\/612 qui concerne l\'agence 612 - Agence DAR EL BEIDA vous a \\u00e9t\\u00e9 assign\\u00e9.","title":"Mission assign\\u00e9e"}',
                'read_at' => NULL,
                'created_at' => '2023-02-20 22:36:35',
                'updated_at' => '2023-02-20 22:36:35',
            ),
            17 => 
            array (
                'id' => '84a0bfc0-e222-4fcd-b4ce-73bf92732df3',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 3,
                'data' => '{"id":"25222f9d-cd36-4b05-8877-b4d2b1e0aa6b","url":"\\/missions\\/25222f9d-cd36-4b05-8877-b4d2b1e0aa6b\\/details\\/25","content":"Un fait majeur vient d\'\\u00eatre d\\u00e9tecter dans la mission 202302\\/612","title":"Fait majeur d\\u00e9tecter"}',
                'read_at' => NULL,
                'created_at' => '2023-02-15 16:23:31',
                'updated_at' => '2023-02-15 16:23:31',
            ),
            18 => 
            array (
                'id' => '84db27f5-a73f-4195-addf-9f37e1a61a7c',
                'type' => 'App\\Notifications\\MissionDetailRegularized',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 2,
                'data' => '{"id":"25222f9d-cd36-4b05-8877-b4d2b1e0aa6b","url":"http:\\/\\/127.0.0.1:8000\\/missions\\/25222f9d-cd36-4b05-8877-b4d2b1e0aa6b","content":"La mission avec la r\\u00e9f\\u00e9rence 202302\\/612 qui concerne l\'agence 612 - Agence DAR EL BEIDA vous a \\u00e9t\\u00e9 assign\\u00e9.","title":"Mission assign\\u00e9e"}',
                'read_at' => NULL,
                'created_at' => '2023-02-22 08:20:00',
                'updated_at' => '2023-02-22 08:20:00',
            ),
            19 => 
            array (
                'id' => '8b75d86f-806e-4849-83be-8a9da75a7562',
                'type' => 'App\\Notifications\\MissionValidatedNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 2,
                'data' => '{"id":"25222f9d-cd36-4b05-8877-b4d2b1e0aa6b","className":"App\\\\Models\\\\Mission","routeName":"mission","paramNames":"missionId","content":"La mission de contr\\u00f4le 202302\\/612 vient d\'\\u00eatre valid\\u00e9e","title":"Mission valid\\u00e9e"}',
                'read_at' => NULL,
                'created_at' => '2023-02-15 13:12:43',
                'updated_at' => '2023-02-15 13:12:43',
            ),
            20 => 
            array (
                'id' => '9dfe43df-b3d5-4306-a477-5c6f92f5f8e1',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 2,
                'data' => '{"id":"25222f9d-cd36-4b05-8877-b4d2b1e0aa6b","url":"\\/missions\\/25222f9d-cd36-4b05-8877-b4d2b1e0aa6b\\/details\\/25","content":"Un fait majeur vient d\'\\u00eatre d\\u00e9tecter dans la mission 202302\\/612","title":"Fait majeur d\\u00e9tecter"}',
                'read_at' => NULL,
                'created_at' => '2023-02-15 16:31:03',
                'updated_at' => '2023-02-15 16:31:03',
            ),
            21 => 
            array (
                'id' => 'a806a4fe-5cd6-4674-a90d-aec6adc7707e',
                'type' => 'App\\Notifications\\MissionValidatedNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 2,
                'data' => '{"id":"25222f9d-cd36-4b05-8877-b4d2b1e0aa6b","className":"App\\\\Models\\\\Mission","routeName":"mission","paramNames":"missionId","content":"La mission de contr\\u00f4le 202302\\/612 vient d\'\\u00eatre valid\\u00e9e","title":"Mission valid\\u00e9e"}',
                'read_at' => NULL,
                'created_at' => '2023-02-15 21:46:51',
                'updated_at' => '2023-02-15 21:46:51',
            ),
            22 => 
            array (
                'id' => 'a85c261c-4d62-4537-946b-5ec955c3f607',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 4,
                'data' => '{"id":"25222f9d-cd36-4b05-8877-b4d2b1e0aa6b","url":"\\/missions\\/25222f9d-cd36-4b05-8877-b4d2b1e0aa6b\\/details\\/25","content":"Un fait majeur vient d\'\\u00eatre d\\u00e9tecter dans la mission 202302\\/612","title":"Fait majeur d\\u00e9tecter"}',
                'read_at' => NULL,
                'created_at' => '2023-02-15 16:31:03',
                'updated_at' => '2023-02-15 16:31:03',
            ),
            23 => 
            array (
                'id' => 'aaf590a9-94fc-4fdc-8aba-0707bdbe5a2c',
                'type' => 'App\\Notifications\\MissionDetailRegularized',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 2,
                'data' => '{"id":"25222f9d-cd36-4b05-8877-b4d2b1e0aa6b","url":"http:\\/\\/127.0.0.1:8000\\/missions\\/25222f9d-cd36-4b05-8877-b4d2b1e0aa6b","content":"La mission avec la r\\u00e9f\\u00e9rence 202302\\/612 qui concerne l\'agence 612 - Agence DAR EL BEIDA vous a \\u00e9t\\u00e9 assign\\u00e9.","title":"Mission assign\\u00e9e"}',
                'read_at' => NULL,
                'created_at' => '2023-02-22 08:07:58',
                'updated_at' => '2023-02-22 08:07:58',
            ),
            24 => 
            array (
                'id' => 'b376c73d-2758-4711-bcda-ebfd7988c50a',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 4,
                'data' => '{"id":"25222f9d-cd36-4b05-8877-b4d2b1e0aa6b","url":"\\/missions\\/25222f9d-cd36-4b05-8877-b4d2b1e0aa6b\\/details\\/25","content":"Un fait majeur vient d\'\\u00eatre d\\u00e9tecter dans la mission 202302\\/612","title":"Fait majeur d\\u00e9tecter"}',
                'read_at' => NULL,
                'created_at' => '2023-02-15 15:12:41',
                'updated_at' => '2023-02-15 15:12:41',
            ),
            25 => 
            array (
                'id' => 'c12edc55-ba5c-483d-96e2-c884437ccb92',
                'type' => 'App\\Notifications\\MissionValidatedNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 18,
                'data' => '{"id":"25222f9d-cd36-4b05-8877-b4d2b1e0aa6b","className":"App\\\\Models\\\\Mission","routeName":"mission","paramNames":"missionId","content":"La mission de contr\\u00f4le 202302\\/612 vient d\'\\u00eatre valid\\u00e9e","title":"Mission valid\\u00e9e"}',
                'read_at' => NULL,
                'created_at' => '2023-02-18 21:37:25',
                'updated_at' => '2023-02-18 21:37:25',
            ),
            26 => 
            array (
                'id' => 'c4812a16-498a-4d50-afa4-c968aeadd92f',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 3,
                'data' => '{"id":"25222f9d-cd36-4b05-8877-b4d2b1e0aa6b","url":"\\/missions\\/25222f9d-cd36-4b05-8877-b4d2b1e0aa6b\\/details\\/25","content":"Un fait majeur vient d\'\\u00eatre d\\u00e9tecter dans la mission 202302\\/612","title":"Fait majeur d\\u00e9tecter"}',
                'read_at' => NULL,
                'created_at' => '2023-02-15 15:12:41',
                'updated_at' => '2023-02-15 15:12:41',
            ),
            27 => 
            array (
                'id' => 'cbcceb62-7e26-4b3e-ab3b-f1a913cf7f01',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 3,
                'data' => '{"id":"25222f9d-cd36-4b05-8877-b4d2b1e0aa6b","url":"\\/missions\\/25222f9d-cd36-4b05-8877-b4d2b1e0aa6b\\/details\\/25","content":"Un fait majeur vient d\'\\u00eatre d\\u00e9tecter dans la mission 202302\\/612","title":"Fait majeur d\\u00e9tecter"}',
                'read_at' => NULL,
                'created_at' => '2023-02-15 16:31:03',
                'updated_at' => '2023-02-15 16:31:03',
            ),
            28 => 
            array (
                'id' => 'd270d5e6-0eef-41b3-acc9-af8bea0105c1',
                'type' => 'App\\Notifications\\MissionValidatedNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 5,
                'data' => '{"id":"25222f9d-cd36-4b05-8877-b4d2b1e0aa6b","className":"App\\\\Models\\\\Mission","routeName":"mission","paramNames":"missionId","content":"La mission de contr\\u00f4le 202302\\/612 vient d\'\\u00eatre valid\\u00e9e","title":"Mission valid\\u00e9e"}',
                'read_at' => NULL,
                'created_at' => '2023-02-18 21:31:46',
                'updated_at' => '2023-02-18 21:31:46',
            ),
            29 => 
            array (
                'id' => 'd9924f2c-a11d-47b3-ba37-e3d95f1a51c7',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 4,
                'data' => '{"id":"25222f9d-cd36-4b05-8877-b4d2b1e0aa6b","url":"\\/missions\\/25222f9d-cd36-4b05-8877-b4d2b1e0aa6b\\/details\\/25","content":"Un fait majeur vient d\'\\u00eatre d\\u00e9tecter dans la mission 202302\\/612","title":"Fait majeur d\\u00e9tecter"}',
                'read_at' => NULL,
                'created_at' => '2023-02-15 16:23:30',
                'updated_at' => '2023-02-15 16:23:30',
            ),
            30 => 
            array (
                'id' => 'd9ae7876-794e-4187-823a-766dd5ba9e29',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 2,
                'data' => '{"id":"25222f9d-cd36-4b05-8877-b4d2b1e0aa6b","url":"\\/missions\\/25222f9d-cd36-4b05-8877-b4d2b1e0aa6b\\/details\\/25","content":"Un fait majeur vient d\'\\u00eatre d\\u00e9tecter dans la mission 202302\\/612","title":"Fait majeur d\\u00e9tecter"}',
                'read_at' => NULL,
                'created_at' => '2023-02-15 15:01:28',
                'updated_at' => '2023-02-15 15:01:28',
            ),
            31 => 
            array (
                'id' => 'dcafe9fd-fbf7-4f7e-89aa-16a8784ace9d',
                'type' => 'App\\Notifications\\MissionAssignedNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 19,
                'data' => '{"id":"25222f9d-cd36-4b05-8877-b4d2b1e0aa6b","url":"http:\\/\\/127.0.0.1:8000\\/missions\\/25222f9d-cd36-4b05-8877-b4d2b1e0aa6b","content":"La mission avec la r\\u00e9f\\u00e9rence 202302\\/612 qui concerne l\'agence 612 - Agence DAR EL BEIDA vous a \\u00e9t\\u00e9 assign\\u00e9.","title":"Assignation de mission"}',
                'read_at' => NULL,
                'created_at' => '2023-02-15 14:24:32',
                'updated_at' => '2023-02-15 14:24:32',
            ),
            32 => 
            array (
                'id' => 'dd5570e3-c694-4a57-a41a-3f5aa58ab9c4',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 4,
                'data' => '{"id":"25222f9d-cd36-4b05-8877-b4d2b1e0aa6b","url":"\\/missions\\/25222f9d-cd36-4b05-8877-b4d2b1e0aa6b\\/details\\/25","content":"Un fait majeur vient d\'\\u00eatre d\\u00e9tecter dans la mission 202302\\/612","title":"Fait majeur d\\u00e9tecter","detail_id":"4e0f01fd-f8b1-42f4-b927-e52179beaf35"}',
                'read_at' => NULL,
                'created_at' => '2023-02-15 16:42:43',
                'updated_at' => '2023-02-15 16:42:43',
            ),
            33 => 
            array (
                'id' => 'e83bf190-f4ca-4c6e-a3ba-206edbc269c4',
                'type' => 'App\\Notifications\\MissionValidatedNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 9,
                'data' => '{"id":"25222f9d-cd36-4b05-8877-b4d2b1e0aa6b","className":"App\\\\Models\\\\Mission","routeName":"mission","paramNames":"missionId","content":"La mission de contr\\u00f4le 202302\\/612 vient d\'\\u00eatre valid\\u00e9e","title":"Mission valid\\u00e9e"}',
                'read_at' => NULL,
                'created_at' => '2023-02-15 21:46:51',
                'updated_at' => '2023-02-15 21:46:51',
            ),
            34 => 
            array (
                'id' => 'e8f7a4b6-e341-465d-aa98-6b41a71741d1',
                'type' => 'App\\Notifications\\MissionValidatedNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 9,
                'data' => '{"id":"25222f9d-cd36-4b05-8877-b4d2b1e0aa6b","className":"App\\\\Models\\\\Mission","routeName":"mission","paramNames":"missionId","content":"La mission de contr\\u00f4le 202302\\/612 vient d\'\\u00eatre valid\\u00e9e","title":"Mission valid\\u00e9e"}',
                'read_at' => NULL,
                'created_at' => '2023-02-18 21:32:22',
                'updated_at' => '2023-02-18 21:32:22',
            ),
            35 => 
            array (
                'id' => 'f7a502bf-222a-4208-a96b-bdac2ce27cee',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 2,
                'data' => '{"id":"25222f9d-cd36-4b05-8877-b4d2b1e0aa6b","url":"\\/missions\\/25222f9d-cd36-4b05-8877-b4d2b1e0aa6b\\/details\\/25","content":"Un fait majeur vient d\'\\u00eatre d\\u00e9tecter dans la mission 202302\\/612","title":"Fait majeur d\\u00e9tecter"}',
                'read_at' => NULL,
                'created_at' => '2023-02-15 15:12:41',
                'updated_at' => '2023-02-15 15:12:41',
            ),
            36 => 
            array (
                'id' => 'fabe6487-a369-48ff-98a1-d4aa5562a846',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 4,
                'data' => '{"id":"25222f9d-cd36-4b05-8877-b4d2b1e0aa6b","url":"\\/missions\\/25222f9d-cd36-4b05-8877-b4d2b1e0aa6b\\/details\\/25","content":"Un fait majeur vient d\'\\u00eatre d\\u00e9tecter dans la mission 202302\\/612","title":"Fait majeur d\\u00e9tecter"}',
                'read_at' => NULL,
                'created_at' => '2023-02-15 15:01:28',
                'updated_at' => '2023-02-15 15:01:28',
            ),
        ));
        
        
    }
}