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
                'created_at' => '2022-12-18 15:49:49',
                'data' => '{"detail_id":433}',
                'id' => '011b52fe-7312-46ae-9435-e748674c0439',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-19 14:56:20',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-19 14:56:20',
            ),
            1 => 
            array (
                'created_at' => '2022-12-19 16:26:31',
                'data' => '{"detail_id":687}',
                'id' => '028120ad-0a77-43f5-a8f8-02f1585a37cc',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-19 16:29:10',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-19 16:29:10',
            ),
            2 => 
            array (
                'created_at' => '2022-12-18 15:27:54',
                'data' => '{"detail_id":414}',
                'id' => '02c36d66-0fef-49b8-b998-b5cff9793f5f',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-18 15:29:57',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-18 15:29:57',
            ),
            3 => 
            array (
                'created_at' => '2022-12-18 16:05:12',
                'data' => '{"detail_id":447}',
                'id' => '084f6c47-a348-451a-a874-d83d8fb8d0a8',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-19 14:56:20',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-19 14:56:20',
            ),
            4 => 
            array (
                'created_at' => '2022-12-19 13:29:05',
                'data' => '{"detail_id":654}',
                'id' => '0f3ced66-526e-4bc0-bdf9-7fdbdc65b2e4',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-19 14:56:20',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-19 14:56:20',
            ),
            5 => 
            array (
                'created_at' => '2022-12-17 19:22:15',
                'data' => '{"detail_id":199}',
                'id' => '12220d35-1668-4607-b9d1-7df69d0afa25',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-17 19:27:46',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-17 19:27:46',
            ),
            6 => 
            array (
                'created_at' => '2022-12-18 03:07:02',
                'data' => '{"detail_id":270}',
                'id' => '1754995c-72c0-41cf-87db-b3c2196640c5',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-18 11:34:00',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-18 11:34:00',
            ),
            7 => 
            array (
                'created_at' => '2022-12-17 14:40:53',
                'data' => '{"detail_id":123}',
                'id' => '220c936f-a676-488e-9052-95c35a7b10e5',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-17 15:09:38',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-17 15:09:38',
            ),
            8 => 
            array (
                'created_at' => '2022-12-18 15:37:55',
                'data' => '{"detail_id":421}',
                'id' => '24725863-c486-4fba-914f-60f3e6fd0b64',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-19 14:56:20',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-19 14:56:20',
            ),
            9 => 
            array (
                'created_at' => '2022-12-18 15:19:45',
                'data' => '{"detail_id":403}',
                'id' => '2cbbf182-f9b0-4265-b59c-cd7f64da7254',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-18 15:20:50',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-18 15:20:50',
            ),
            10 => 
            array (
                'created_at' => '2022-12-19 09:03:13',
                'data' => '{"detail_id":572}',
                'id' => '3291b678-4f91-4b08-8f41-013e2ffd0c00',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-19 14:56:20',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-19 14:56:20',
            ),
            11 => 
            array (
                'created_at' => '2022-12-17 20:16:30',
                'data' => '{"detail_id":214}',
                'id' => '33c71dff-014e-4b0b-b655-9991a77c569c',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-18 11:34:00',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-18 11:34:00',
            ),
            12 => 
            array (
                'created_at' => '2022-12-17 22:32:35',
                'data' => '{"detail_id":231}',
                'id' => '3698f072-3e88-4184-a1ad-91a1a234eda2',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-18 11:34:00',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-18 11:34:00',
            ),
            13 => 
            array (
                'created_at' => '2022-12-17 14:51:42',
                'data' => '{"detail_id":138}',
                'id' => '36b9da52-1b4c-4f9a-b291-d1abbff07bf0',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-17 15:09:38',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-17 15:09:38',
            ),
            14 => 
            array (
                'created_at' => '2022-12-17 21:54:26',
                'data' => '{"detail_id":219}',
                'id' => '38ae378d-7639-472b-bfc2-3c23cdbe17e3',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-18 11:34:00',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-18 11:34:00',
            ),
            15 => 
            array (
                'created_at' => '2022-12-18 12:27:54',
                'data' => '{"detail_id":354}',
                'id' => '4675cc15-8783-4ef6-bf07-23238f629ab2',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-18 14:19:50',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-18 14:19:50',
            ),
            16 => 
            array (
                'created_at' => '2022-12-17 14:40:53',
                'data' => '{"detail_id":121}',
                'id' => '471c36d8-71da-492f-a56e-c09bd945b791',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-17 15:09:38',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-17 15:09:38',
            ),
            17 => 
            array (
                'created_at' => '2022-12-18 11:55:26',
                'data' => '{"detail_id":323}',
                'id' => '47f7c9ef-14fb-475b-a5f1-ecd4332c9014',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-18 14:19:50',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-18 14:19:50',
            ),
            18 => 
            array (
                'created_at' => '2022-12-18 01:22:25',
                'data' => '{"detail_id":246}',
                'id' => '496b2b8b-9d54-47dc-ab35-0c3f7dbd3968',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-18 11:34:00',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-18 11:34:00',
            ),
            19 => 
            array (
                'created_at' => '2022-12-18 16:21:52',
                'data' => '{"detail_id":472}',
                'id' => '49ef9338-f4ea-43d4-a7f5-707ff96fadb6',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-19 14:56:20',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-19 14:56:20',
            ),
            20 => 
            array (
                'created_at' => '2022-12-18 00:54:55',
                'data' => '{"detail_id":243}',
                'id' => '4a9e56d8-eba7-4a3d-a878-363293e5d34f',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-18 11:34:00',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-18 11:34:00',
            ),
            21 => 
            array (
                'created_at' => '2022-12-19 00:22:49',
                'data' => '{"detail_id":539}',
                'id' => '52f08ae2-3251-4fb0-90c4-29015eaaa00a',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-19 14:56:20',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-19 14:56:20',
            ),
            22 => 
            array (
                'created_at' => '2022-12-17 19:20:45',
                'data' => '{"detail_id":194}',
                'id' => '533c8333-ddb0-4ab4-a851-41d1ee604825',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-17 19:27:46',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-17 19:27:46',
            ),
            23 => 
            array (
                'created_at' => '2022-12-18 14:04:33',
                'data' => '{"detail_id":378}',
                'id' => '551dac54-4bf4-4103-a1db-07924cc60f62',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-18 14:19:50',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-18 14:19:50',
            ),
            24 => 
            array (
                'created_at' => '2022-12-19 10:08:10',
                'data' => '{"detail_id":592}',
                'id' => '56ac4d05-8640-4529-84c8-7e606721f66a',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-19 14:56:20',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-19 14:56:20',
            ),
            25 => 
            array (
                'created_at' => '2022-12-18 01:25:54',
                'data' => '{"detail_id":249}',
                'id' => '5d2f0e7e-cbfe-4249-b908-cc9aebe09a0a',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-18 11:34:00',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-18 11:34:00',
            ),
            26 => 
            array (
                'created_at' => '2022-12-19 12:04:40',
                'data' => '{"detail_id":622}',
                'id' => '5d45debf-d04e-464e-af10-d15c611facb9',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-19 14:56:20',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-19 14:56:20',
            ),
            27 => 
            array (
                'created_at' => '2022-12-18 15:19:45',
                'data' => '{"detail_id":404}',
                'id' => '61c3ba7a-594b-447b-8f84-a6ea1c9f7d15',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-18 15:20:50',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-18 15:20:50',
            ),
            28 => 
            array (
                'created_at' => '2022-12-18 11:24:21',
                'data' => '{"detail_id":282}',
                'id' => '67d59b10-2d11-4caf-b581-47615f6194b8',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-18 11:34:00',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-18 11:34:00',
            ),
            29 => 
            array (
                'created_at' => '2022-12-18 11:39:14',
                'data' => '{"detail_id":303}',
                'id' => '6a585d4e-344a-4136-add4-cee2156fcd81',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-18 14:19:50',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-18 14:19:50',
            ),
            30 => 
            array (
                'created_at' => '2022-12-17 19:20:45',
                'data' => '{"detail_id":196}',
                'id' => '6edd3c24-5201-4912-a945-5f349c6cecef',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-17 19:27:46',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-17 19:27:46',
            ),
            31 => 
            array (
                'created_at' => '2022-12-18 11:52:09',
                'data' => '{"detail_id":315}',
                'id' => '7ba70f59-4ab7-463b-a73e-9562c4b38441',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-18 14:19:50',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-18 14:19:50',
            ),
            32 => 
            array (
                'created_at' => '2022-12-17 15:51:22',
                'data' => '{"detail_id":157}',
                'id' => '7c898986-1257-4fe9-a6f2-a3e60eb63fbf',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-17 16:03:33',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-17 16:03:33',
            ),
            33 => 
            array (
                'created_at' => '2022-12-17 22:10:49',
                'data' => '{"detail_id":222}',
                'id' => '824ca5dd-bc3f-4d9e-975d-6cf2dbb19160',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-18 11:34:00',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-18 11:34:00',
            ),
            34 => 
            array (
                'created_at' => '2022-12-18 16:27:18',
                'data' => '{"detail_id":489}',
                'id' => '86224942-a905-4d8a-9e94-ba2012f7a17d',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-19 14:56:20',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-19 14:56:20',
            ),
            35 => 
            array (
                'created_at' => '2022-12-18 15:27:54',
                'data' => '{"detail_id":413}',
                'id' => '86ddcaac-ce13-4733-bfd7-b5afd25a6447',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-18 15:29:57',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-18 15:29:57',
            ),
            36 => 
            array (
                'created_at' => '2022-12-18 11:28:36',
                'data' => '{"detail_id":299}',
                'id' => '8a14825d-1140-4e23-858c-6c7a431beb9b',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-18 11:34:00',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-18 11:34:00',
            ),
            37 => 
            array (
                'created_at' => '2022-12-19 17:11:56',
                'data' => '{"detail_id":701}',
                'id' => '907079b8-4714-4293-ac3a-64e74f985d13',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-19 16:29:10',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-19 16:29:10',
            ),
            38 => 
            array (
                'created_at' => '2022-12-17 15:47:07',
                'data' => '{"detail_id":151}',
                'id' => '951ec436-23ba-4558-891c-468dc5ff0d43',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-17 16:03:33',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-17 16:03:33',
            ),
            39 => 
            array (
                'created_at' => '2022-12-19 08:50:35',
                'data' => '{"detail_id":553}',
                'id' => '9d1b7c2d-2316-4832-b093-c88486845317',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-19 14:56:20',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-19 14:56:20',
            ),
            40 => 
            array (
                'created_at' => '2022-12-18 16:35:41',
                'data' => '{"detail_id":506}',
                'id' => '9fa77a9a-1c1d-42fc-ab5e-5d4c15f61757',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-19 14:56:20',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-19 14:56:20',
            ),
            41 => 
            array (
                'created_at' => '2022-12-17 16:15:37',
                'data' => '{"detail_id":161}',
                'id' => 'a0ce9530-0aa9-4563-8215-a98603dd9866',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-17 16:18:04',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-17 16:18:04',
            ),
            42 => 
            array (
                'created_at' => '2022-12-17 15:51:22',
                'data' => '{"detail_id":156}',
                'id' => 'a2a096df-2ec1-4d6c-b56e-388949bfb235',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-17 16:03:33',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-17 16:03:33',
            ),
            43 => 
            array (
                'created_at' => '2022-12-17 14:53:21',
                'data' => '{"detail_id":142}',
                'id' => 'a362e0f7-3eb6-40f6-a104-d36882f8c534',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-17 15:09:38',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-17 15:09:38',
            ),
            44 => 
            array (
                'created_at' => '2022-12-19 00:22:49',
                'data' => '{"detail_id":538}',
                'id' => 'a57e4efa-9e05-4dca-a7f7-ddc0984757de',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-19 14:56:20',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-19 14:56:20',
            ),
            45 => 
            array (
                'created_at' => '2022-12-18 15:19:45',
                'data' => '{"detail_id":408}',
                'id' => 'a8f073a8-1d7d-4731-ac54-74c2783af2e9',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-18 15:20:50',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-18 15:20:50',
            ),
            46 => 
            array (
                'created_at' => '2022-12-19 09:01:08',
                'data' => '{"detail_id":562}',
                'id' => 'af364610-ef12-40a1-a457-ca56a7f15b1c',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-19 14:56:20',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-19 14:56:20',
            ),
            47 => 
            array (
                'created_at' => '2022-12-18 14:06:08',
                'data' => '{"detail_id":387}',
                'id' => 'b70e16ba-1a2f-4c6d-9c12-6996faa99f8a',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-18 14:19:50',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-18 14:19:50',
            ),
            48 => 
            array (
                'created_at' => '2022-12-17 20:16:30',
                'data' => '{"detail_id":210}',
                'id' => 'b7a834b7-8902-4207-ac82-283a760779ae',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-18 11:34:00',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-18 11:34:00',
            ),
            49 => 
            array (
                'created_at' => '2022-12-18 12:15:45',
                'data' => '{"detail_id":339}',
                'id' => 'c403c8f6-decf-448e-ad08-27d72d4c19e4',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-18 14:19:50',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-18 14:19:50',
            ),
            50 => 
            array (
                'created_at' => '2022-12-18 00:49:37',
                'data' => '{"detail_id":234}',
                'id' => 'cabe1a48-d53e-4567-b962-8b63aa90f364',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-18 11:34:00',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-18 11:34:00',
            ),
            51 => 
            array (
                'created_at' => '2022-12-18 16:03:44',
                'data' => '{"detail_id":438}',
                'id' => 'cf28df81-e182-4acb-9505-a717ae54437f',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-19 14:56:20',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-19 14:56:20',
            ),
            52 => 
            array (
                'created_at' => '2022-12-18 12:21:34',
                'data' => '{"detail_id":342}',
                'id' => 'd07a98da-90b4-45bd-817c-0fea0182dbd6',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-18 14:19:50',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-18 14:19:50',
            ),
            53 => 
            array (
                'created_at' => '2022-12-18 16:52:45',
                'data' => '{"detail_id":515}',
                'id' => 'd9622024-5b9b-4558-b189-33f32e75eb8f',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-19 14:56:20',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-19 14:56:20',
            ),
            54 => 
            array (
                'created_at' => '2022-12-19 00:28:40',
                'data' => '{"detail_id":548}',
                'id' => 'd9ca05f5-8126-4dab-a0a6-fe513f0b4194',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-19 14:56:20',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-19 14:56:20',
            ),
            55 => 
            array (
                'created_at' => '2022-12-18 16:29:23',
                'data' => '{"detail_id":498}',
                'id' => 'dc63e31f-4de4-40e5-9f64-afa46a1a9445',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-19 14:56:20',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-19 14:56:20',
            ),
            56 => 
            array (
                'created_at' => '2022-12-19 00:03:46',
                'data' => '{"detail_id":523}',
                'id' => 'dc6a560e-7dc4-4aa9-90a2-c4e313d3d0b8',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-19 14:56:20',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-19 14:56:20',
            ),
            57 => 
            array (
                'created_at' => '2022-12-18 16:03:44',
                'data' => '{"detail_id":437}',
                'id' => 'dfd68274-a4d0-47ff-8870-11c58e2170ae',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-19 14:56:20',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-19 14:56:20',
            ),
            58 => 
            array (
                'created_at' => '2022-12-18 12:14:47',
                'data' => '{"detail_id":330}',
                'id' => 'e04a0f1b-ea5c-4aa0-9b16-573ee3525049',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-18 14:19:50',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-18 14:19:50',
            ),
            59 => 
            array (
                'created_at' => '2022-12-18 15:37:55',
                'data' => '{"detail_id":420}',
                'id' => 'e66da88f-6efe-45a1-9d87-e6c4288d7915',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-19 14:56:20',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-19 14:56:20',
            ),
            60 => 
            array (
                'created_at' => '2022-12-17 22:22:22',
                'data' => '{"detail_id":227}',
                'id' => 'e8fcd529-ae6e-4251-9c4a-ff3cc0025c31',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-18 11:34:00',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-18 11:34:00',
            ),
            61 => 
            array (
                'created_at' => '2022-12-19 09:15:59',
                'data' => '{"detail_id":587}',
                'id' => 'eab366fd-c25c-42b6-886f-1bea3c814ae8',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-19 14:56:20',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-19 14:56:20',
            ),
            62 => 
            array (
                'created_at' => '2022-12-19 10:09:08',
                'data' => '{"detail_id":602}',
                'id' => 'ee51ac75-6ae5-4ec7-b201-d32f28ad37ce',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-19 14:56:20',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-19 14:56:20',
            ),
            63 => 
            array (
                'created_at' => '2022-12-18 00:49:37',
                'data' => '{"detail_id":238}',
                'id' => 'f01cc731-eadd-410e-8fc3-bda5f118b9bc',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-18 11:34:00',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-18 11:34:00',
            ),
            64 => 
            array (
                'created_at' => '2022-12-19 08:50:35',
                'data' => '{"detail_id":556}',
                'id' => 'f11d2eff-90ac-40b1-be10-344449010456',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2022-12-19 14:56:20',
                'type' => 'App\\Notifications\\MajorFactDetectedNotification',
                'updated_at' => '2022-12-19 14:56:20',
            ),
        ));
        
        
    }
}