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
                'created_at' => '2023-03-04 17:51:57',
                'data' => '{"id":"00fcb4c5-7c42-40c2-8f0c-42f1b7f7ddd1","url":"http:\\/\\/127.0.0.1:8000\\/major-facts?filter[id]=00fcb4c5-7c42-40c2-8f0c-42f1b7f7ddd1","content":"Un fait majeur vient d\'\\u00eatre d\\u00e9tecter dans la mission 202302\\/613","title":"Fait majeur d\\u00e9tecter"}',
                'id' => '033d07b1-c3ea-4348-a0c0-25aade56fb06',
                'notifiable_id' => 3,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => NULL,
                'type' => 'App\\Notifications\\Mission\\MajorFact\\Detected',
                'updated_at' => '2023-03-04 17:51:57',
            ),
            1 => 
            array (
                'created_at' => '2023-03-04 17:03:51',
                'data' => '{"id":2,"url":"http:\\/\\/127.0.0.1:8000\\/campaigns\\/2","content":"Nous vous informons qu\'une nouvelle campagne de contr\\u00f4le avec la r\\u00e9f\\u00e9rence CDC-2023-02 vient d\'\\u00eatre cr\\u00e9er","title":"Cr\\u00e9ation d\'une nouvelle campagne de contr\\u00f4le CDC-2023-02","transmitter":2}',
                'id' => '045f543d-1ba6-4518-9a1e-7c129ab3c2d0',
                'notifiable_id' => 18,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2023-03-04 17:04:24',
                'type' => 'App\\Notifications\\ControlCampaign\\Created',
                'updated_at' => '2023-03-04 17:04:24',
            ),
            2 => 
            array (
                'created_at' => '2023-03-04 19:52:35',
                'data' => '{"id":"4a399675-dd14-4868-b727-183ef3525b9f","url":"http:\\/\\/127.0.0.1:8000\\/missions\\/4a399675-dd14-4868-b727-183ef3525b9f","content":"Une nouvelle mission avec la r\\u00e9f\\u00e9rence RAP202302\\/613 pour l\'agence 613 - Agence A\\u00e9roport HB vous a \\u00e9t\\u00e9 assign\\u00e9.","title":"Assignation de mission"}',
                'id' => '053929ea-64ba-4341-bc25-3bb48d60dd68',
                'notifiable_id' => 19,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => NULL,
                'type' => 'App\\Notifications\\Mission\\Assigned',
                'updated_at' => '2023-03-04 19:52:35',
            ),
            3 => 
            array (
                'created_at' => '2023-03-04 17:05:08',
                'data' => '{"id":1,"url":"http:\\/\\/127.0.0.1:8000\\/campaigns\\/1","content":"Nous vous informons qu\'une nouvelle campagne de contr\\u00f4le avec la r\\u00e9f\\u00e9rence CDC-2023-01 vient d\'\\u00eatre cr\\u00e9er","title":"Cr\\u00e9ation d\'une nouvelle campagne de contr\\u00f4le CDC-2023-01","transmitter":2}',
                'id' => '09ca9c62-b2ff-4f47-b137-319564dae45a',
                'notifiable_id' => 8,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => NULL,
                'type' => 'App\\Notifications\\ControlCampaign\\Created',
                'updated_at' => '2023-03-04 17:05:08',
            ),
            4 => 
            array (
                'created_at' => '2023-03-04 17:12:20',
                'data' => '{"id":"00fcb4c5-7c42-40c2-8f0c-42f1b7f7ddd1","url":"http:\\/\\/127.0.0.1:8000\\/major-facts?filter[id]=00fcb4c5-7c42-40c2-8f0c-42f1b7f7ddd1","content":"Un fait majeur vient d\'\\u00eatre d\\u00e9tecter dans la mission 202302\\/613","title":"Fait majeur d\\u00e9tecter"}',
                'id' => '0f7a62cc-f3a1-4922-9ea3-f7bd6ea94f03',
                'notifiable_id' => 5,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2023-03-04 18:34:16',
                'type' => 'App\\Notifications\\Mission\\MajorFact\\Detected',
                'updated_at' => '2023-03-04 18:34:16',
            ),
            5 => 
            array (
                'created_at' => '2023-03-04 17:03:51',
                'data' => '{"id":2,"url":"http:\\/\\/127.0.0.1:8000\\/campaigns\\/2","content":"Nous vous informons qu\'une nouvelle campagne de contr\\u00f4le avec la r\\u00e9f\\u00e9rence CDC-2023-02 vient d\'\\u00eatre cr\\u00e9er","title":"Cr\\u00e9ation d\'une nouvelle campagne de contr\\u00f4le CDC-2023-02","transmitter":2}',
                'id' => '19172dc7-6dc7-41a9-ba58-f367daa2d3bb',
                'notifiable_id' => 13,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => NULL,
                'type' => 'App\\Notifications\\ControlCampaign\\Created',
                'updated_at' => '2023-03-04 17:03:51',
            ),
            6 => 
            array (
                'created_at' => '2023-03-04 17:05:09',
                'data' => '{"id":1,"url":"http:\\/\\/127.0.0.1:8000\\/campaigns\\/1","content":"Nous vous informons qu\'une nouvelle campagne de contr\\u00f4le avec la r\\u00e9f\\u00e9rence CDC-2023-01 vient d\'\\u00eatre cr\\u00e9er","title":"Cr\\u00e9ation d\'une nouvelle campagne de contr\\u00f4le CDC-2023-01","transmitter":2}',
                'id' => '1fbc1a8a-4eb3-4bcf-b564-209532f4253d',
                'notifiable_id' => 20,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => NULL,
                'type' => 'App\\Notifications\\ControlCampaign\\Created',
                'updated_at' => '2023-03-04 17:05:09',
            ),
            7 => 
            array (
                'created_at' => '2023-03-04 17:03:35',
                'data' => '{"id":2,"url":"http:\\/\\/127.0.0.1:8000\\/campaigns\\/2","content":"Nous vous informons qu\'une nouvelle campagne de contr\\u00f4le avec la r\\u00e9f\\u00e9rence CDC-2023-02 vient d\'\\u00eatre cr\\u00e9er","title":"Cr\\u00e9ation d\'une nouvelle campagne de contr\\u00f4le CDC-2023-02","transmitter":2}',
                'id' => '22ad0c45-d614-4717-ba6a-c0c3c78aa2e9',
                'notifiable_id' => 18,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2023-03-04 17:04:24',
                'type' => 'App\\Notifications\\ControlCampaign\\Created',
                'updated_at' => '2023-03-04 17:04:24',
            ),
            8 => 
            array (
                'created_at' => '2023-03-04 18:34:56',
                'data' => '{"id":"4a399675-dd14-4868-b727-183ef3525b9f","url":"http:\\/\\/127.0.0.1:8000\\/missions\\/4a399675-dd14-4868-b727-183ef3525b9f","content":"Mission RAP202302\\/613 a \\u00e9t\\u00e9 r\\u00e9alis\\u00e9","title":"Mission RAP202302\\/613 valid\\u00e9e"}',
                'id' => '2d110634-f793-4917-a990-51a2f019db0f',
                'notifiable_id' => 9,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2023-03-04 18:35:36',
                'type' => 'App\\Notifications\\Mission\\Validated',
                'updated_at' => '2023-03-04 18:35:36',
            ),
            9 => 
            array (
                'created_at' => '2023-03-04 17:51:57',
                'data' => '{"id":"00fcb4c5-7c42-40c2-8f0c-42f1b7f7ddd1","url":"http:\\/\\/127.0.0.1:8000\\/major-facts?filter[id]=00fcb4c5-7c42-40c2-8f0c-42f1b7f7ddd1","content":"Un fait majeur vient d\'\\u00eatre d\\u00e9tecter dans la mission 202302\\/613","title":"Fait majeur d\\u00e9tecter"}',
                'id' => '3273b6d0-8243-4e41-92ce-47fe2556af15',
                'notifiable_id' => 4,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => NULL,
                'type' => 'App\\Notifications\\Mission\\MajorFact\\Detected',
                'updated_at' => '2023-03-04 17:51:57',
            ),
            10 => 
            array (
                'created_at' => '2023-03-04 17:03:51',
                'data' => '{"id":2,"url":"http:\\/\\/127.0.0.1:8000\\/campaigns\\/2","content":"Nous vous informons qu\'une nouvelle campagne de contr\\u00f4le avec la r\\u00e9f\\u00e9rence CDC-2023-02 vient d\'\\u00eatre cr\\u00e9er","title":"Cr\\u00e9ation d\'une nouvelle campagne de contr\\u00f4le CDC-2023-02","transmitter":2}',
                'id' => '3c48ab5c-b177-45fb-a5a8-347e90f3599a',
                'notifiable_id' => 3,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => NULL,
                'type' => 'App\\Notifications\\ControlCampaign\\Created',
                'updated_at' => '2023-03-04 17:03:51',
            ),
            11 => 
            array (
                'created_at' => '2023-03-04 16:57:53',
                'data' => '{"id":1,"url":"http:\\/\\/127.0.0.1:8000\\/campaigns\\/1","content":"Nous vous informons qu\'une nouvelle campagne de contr\\u00f4le avec la r\\u00e9f\\u00e9rence CDC-2023-01 vient d\'\\u00eatre cr\\u00e9er","title":"Cr\\u00e9ation d\'une nouvelle campagne de contr\\u00f4le CDC-2023-01","transmitter":2}',
                'id' => '3ce235ca-33a3-4aac-9b65-631813cd0a0e',
                'notifiable_id' => 18,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2023-03-04 16:57:56',
                'type' => 'App\\Notifications\\ControlCampaign\\Created',
                'updated_at' => '2023-03-04 16:57:56',
            ),
            12 => 
            array (
                'created_at' => '2023-03-04 17:03:51',
                'data' => '{"id":2,"url":"http:\\/\\/127.0.0.1:8000\\/campaigns\\/2","content":"Nous vous informons qu\'une nouvelle campagne de contr\\u00f4le avec la r\\u00e9f\\u00e9rence CDC-2023-02 vient d\'\\u00eatre cr\\u00e9er","title":"Cr\\u00e9ation d\'une nouvelle campagne de contr\\u00f4le CDC-2023-02","transmitter":2}',
                'id' => '40d66fc5-447f-4b20-889c-37854a8d3316',
                'notifiable_id' => 4,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => NULL,
                'type' => 'App\\Notifications\\ControlCampaign\\Created',
                'updated_at' => '2023-03-04 17:03:51',
            ),
            13 => 
            array (
                'created_at' => '2023-03-04 17:05:08',
                'data' => '{"id":1,"url":"http:\\/\\/127.0.0.1:8000\\/campaigns\\/1","content":"Nous vous informons qu\'une nouvelle campagne de contr\\u00f4le avec la r\\u00e9f\\u00e9rence CDC-2023-01 vient d\'\\u00eatre cr\\u00e9er","title":"Cr\\u00e9ation d\'une nouvelle campagne de contr\\u00f4le CDC-2023-01","transmitter":2}',
                'id' => '4dfd8761-588e-4011-9bae-d238ba4dca85',
                'notifiable_id' => 6,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => NULL,
                'type' => 'App\\Notifications\\ControlCampaign\\Created',
                'updated_at' => '2023-03-04 17:05:08',
            ),
            14 => 
            array (
                'created_at' => '2023-03-04 17:03:51',
                'data' => '{"id":2,"url":"http:\\/\\/127.0.0.1:8000\\/campaigns\\/2","content":"Nous vous informons qu\'une nouvelle campagne de contr\\u00f4le avec la r\\u00e9f\\u00e9rence CDC-2023-02 vient d\'\\u00eatre cr\\u00e9er","title":"Cr\\u00e9ation d\'une nouvelle campagne de contr\\u00f4le CDC-2023-02","transmitter":2}',
                'id' => '6607ee6d-5395-49b8-a83a-1e7eed887ed6',
                'notifiable_id' => 6,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => NULL,
                'type' => 'App\\Notifications\\ControlCampaign\\Created',
                'updated_at' => '2023-03-04 17:03:51',
            ),
            15 => 
            array (
                'created_at' => '2023-03-04 18:34:56',
                'data' => '{"id":"4a399675-dd14-4868-b727-183ef3525b9f","url":"http:\\/\\/127.0.0.1:8000\\/missions\\/4a399675-dd14-4868-b727-183ef3525b9f","content":"Mission RAP202302\\/613 a \\u00e9t\\u00e9 r\\u00e9alis\\u00e9","title":"Mission RAP202302\\/613 valid\\u00e9e"}',
                'id' => '6ce7633f-9856-4a28-a0ef-de8b4ceea26f',
                'notifiable_id' => 18,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2023-03-04 19:17:52',
                'type' => 'App\\Notifications\\Mission\\Validated',
                'updated_at' => '2023-03-04 19:17:52',
            ),
            16 => 
            array (
                'created_at' => '2023-03-04 17:03:51',
                'data' => '{"id":2,"url":"http:\\/\\/127.0.0.1:8000\\/campaigns\\/2","content":"Nous vous informons qu\'une nouvelle campagne de contr\\u00f4le avec la r\\u00e9f\\u00e9rence CDC-2023-02 vient d\'\\u00eatre cr\\u00e9er","title":"Cr\\u00e9ation d\'une nouvelle campagne de contr\\u00f4le CDC-2023-02","transmitter":2}',
                'id' => '76f124fe-59df-4a13-9847-19c2d705adcd',
                'notifiable_id' => 8,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => NULL,
                'type' => 'App\\Notifications\\ControlCampaign\\Created',
                'updated_at' => '2023-03-04 17:03:51',
            ),
            17 => 
            array (
                'created_at' => '2023-03-04 17:05:08',
                'data' => '{"id":1,"url":"http:\\/\\/127.0.0.1:8000\\/campaigns\\/1","content":"Nous vous informons qu\'une nouvelle campagne de contr\\u00f4le avec la r\\u00e9f\\u00e9rence CDC-2023-01 vient d\'\\u00eatre cr\\u00e9er","title":"Cr\\u00e9ation d\'une nouvelle campagne de contr\\u00f4le CDC-2023-01","transmitter":2}',
                'id' => '79ed8b39-e651-4eee-adbb-1df51fab59c4',
                'notifiable_id' => 3,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => NULL,
                'type' => 'App\\Notifications\\ControlCampaign\\Created',
                'updated_at' => '2023-03-04 17:05:08',
            ),
            18 => 
            array (
                'created_at' => '2023-03-04 17:05:08',
                'data' => '{"id":1,"url":"http:\\/\\/127.0.0.1:8000\\/campaigns\\/1","content":"Nous vous informons qu\'une nouvelle campagne de contr\\u00f4le avec la r\\u00e9f\\u00e9rence CDC-2023-01 vient d\'\\u00eatre cr\\u00e9er","title":"Cr\\u00e9ation d\'une nouvelle campagne de contr\\u00f4le CDC-2023-01","transmitter":2}',
                'id' => '7b41e208-0d92-42fe-a2c8-90789fcd18de',
                'notifiable_id' => 7,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => NULL,
                'type' => 'App\\Notifications\\ControlCampaign\\Created',
                'updated_at' => '2023-03-04 17:05:08',
            ),
            19 => 
            array (
                'created_at' => '2023-03-04 17:08:09',
                'data' => '{"id":"4a399675-dd14-4868-b727-183ef3525b9f","url":"http:\\/\\/127.0.0.1:8000\\/missions\\/4a399675-dd14-4868-b727-183ef3525b9f","content":"Une nouvelle mission avec la r\\u00e9f\\u00e9rence 202302\\/613 pour l\'agence 613 - Agence A\\u00e9roport HB vous a \\u00e9t\\u00e9 assign\\u00e9.","title":"Assignation de mission"}',
                'id' => '7c58062c-8a35-4722-a3fc-3f0397f8bf19',
                'notifiable_id' => 9,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2023-03-04 17:08:39',
                'type' => 'App\\Notifications\\Mission\\Assigned',
                'updated_at' => '2023-03-04 17:08:39',
            ),
            20 => 
            array (
                'created_at' => '2023-03-04 17:12:20',
                'data' => '{"id":"00fcb4c5-7c42-40c2-8f0c-42f1b7f7ddd1","url":"http:\\/\\/127.0.0.1:8000\\/major-facts?filter[id]=00fcb4c5-7c42-40c2-8f0c-42f1b7f7ddd1","content":"Un fait majeur vient d\'\\u00eatre d\\u00e9tecter dans la mission 202302\\/613","title":"Fait majeur d\\u00e9tecter"}',
                'id' => '7e6227ca-a226-40c6-a0cf-64fc476181b1',
                'notifiable_id' => 18,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2023-03-04 19:17:52',
                'type' => 'App\\Notifications\\Mission\\MajorFact\\Detected',
                'updated_at' => '2023-03-04 19:17:52',
            ),
            21 => 
            array (
                'created_at' => '2023-03-04 17:03:51',
                'data' => '{"id":2,"url":"http:\\/\\/127.0.0.1:8000\\/campaigns\\/2","content":"Nous vous informons qu\'une nouvelle campagne de contr\\u00f4le avec la r\\u00e9f\\u00e9rence CDC-2023-02 vient d\'\\u00eatre cr\\u00e9er","title":"Cr\\u00e9ation d\'une nouvelle campagne de contr\\u00f4le CDC-2023-02","transmitter":2}',
                'id' => '84766b5d-4c1c-4b60-8d0d-6629966c6a16',
                'notifiable_id' => 20,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => NULL,
                'type' => 'App\\Notifications\\ControlCampaign\\Created',
                'updated_at' => '2023-03-04 17:03:51',
            ),
            22 => 
            array (
                'created_at' => '2023-03-04 17:12:20',
                'data' => '{"id":"00fcb4c5-7c42-40c2-8f0c-42f1b7f7ddd1","url":"http:\\/\\/127.0.0.1:8000\\/major-facts?filter[id]=00fcb4c5-7c42-40c2-8f0c-42f1b7f7ddd1","content":"Un fait majeur vient d\'\\u00eatre d\\u00e9tecter dans la mission 202302\\/613","title":"Fait majeur d\\u00e9tecter"}',
                'id' => '85361231-f19e-4972-b93c-abf4c8eb841e',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2023-03-04 19:18:06',
                'type' => 'App\\Notifications\\Mission\\MajorFact\\Detected',
                'updated_at' => '2023-03-04 19:18:06',
            ),
            23 => 
            array (
                'created_at' => '2023-03-04 17:03:51',
                'data' => '{"id":2,"url":"http:\\/\\/127.0.0.1:8000\\/campaigns\\/2","content":"Nous vous informons qu\'une nouvelle campagne de contr\\u00f4le avec la r\\u00e9f\\u00e9rence CDC-2023-02 vient d\'\\u00eatre cr\\u00e9er","title":"Cr\\u00e9ation d\'une nouvelle campagne de contr\\u00f4le CDC-2023-02","transmitter":2}',
                'id' => '87515b75-f86d-44fd-aa6b-092ce953d2d1',
                'notifiable_id' => 7,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => NULL,
                'type' => 'App\\Notifications\\ControlCampaign\\Created',
                'updated_at' => '2023-03-04 17:03:51',
            ),
            24 => 
            array (
                'created_at' => '2023-03-04 19:19:50',
                'data' => '{"id":"4a399675-dd14-4868-b727-183ef3525b9f","url":"http:\\/\\/127.0.0.1:8000\\/missions\\/4a399675-dd14-4868-b727-183ef3525b9f","content":"Mission RAP202302\\/613 a \\u00e9t\\u00e9 r\\u00e9alis\\u00e9","title":"Mission RAP202302\\/613 valid\\u00e9e"}',
                'id' => '90c837d5-feb4-4308-87c3-4b4af47c14e8',
                'notifiable_id' => 9,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => NULL,
                'type' => 'App\\Notifications\\Mission\\Validated',
                'updated_at' => '2023-03-04 19:19:50',
            ),
            25 => 
            array (
                'created_at' => '2023-03-04 17:03:51',
                'data' => '{"id":2,"url":"http:\\/\\/127.0.0.1:8000\\/campaigns\\/2","content":"Nous vous informons qu\'une nouvelle campagne de contr\\u00f4le avec la r\\u00e9f\\u00e9rence CDC-2023-02 vient d\'\\u00eatre cr\\u00e9er","title":"Cr\\u00e9ation d\'une nouvelle campagne de contr\\u00f4le CDC-2023-02","transmitter":2}',
                'id' => 'a6962b33-b00f-49ca-aa8f-2eea64b53e88',
                'notifiable_id' => 15,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => NULL,
                'type' => 'App\\Notifications\\ControlCampaign\\Created',
                'updated_at' => '2023-03-04 17:03:51',
            ),
            26 => 
            array (
                'created_at' => '2023-03-04 17:51:57',
                'data' => '{"id":"00fcb4c5-7c42-40c2-8f0c-42f1b7f7ddd1","url":"http:\\/\\/127.0.0.1:8000\\/major-facts?filter[id]=00fcb4c5-7c42-40c2-8f0c-42f1b7f7ddd1","content":"Un fait majeur vient d\'\\u00eatre d\\u00e9tecter dans la mission 202302\\/613","title":"Fait majeur d\\u00e9tecter"}',
                'id' => 'ae3a4807-436d-4093-bf9d-0c61cbe1de39',
                'notifiable_id' => 20,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => NULL,
                'type' => 'App\\Notifications\\Mission\\MajorFact\\Detected',
                'updated_at' => '2023-03-04 17:51:57',
            ),
            27 => 
            array (
                'created_at' => '2023-03-04 17:51:57',
                'data' => '{"id":"00fcb4c5-7c42-40c2-8f0c-42f1b7f7ddd1","url":"http:\\/\\/127.0.0.1:8000\\/major-facts?filter[id]=00fcb4c5-7c42-40c2-8f0c-42f1b7f7ddd1","content":"Un fait majeur vient d\'\\u00eatre d\\u00e9tecter dans la mission 202302\\/613","title":"Fait majeur d\\u00e9tecter"}',
                'id' => 'b6571243-0387-42fd-98fb-76ccf8166b65',
                'notifiable_id' => 25,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => NULL,
                'type' => 'App\\Notifications\\Mission\\MajorFact\\Detected',
                'updated_at' => '2023-03-04 17:51:57',
            ),
            28 => 
            array (
                'created_at' => '2023-03-04 17:05:09',
                'data' => '{"id":1,"url":"http:\\/\\/127.0.0.1:8000\\/campaigns\\/1","content":"Nous vous informons que la campagne de contr\\u00f4le avec la r\\u00e9f\\u00e9rence CDC-2023-01 vient d\'\\u00eatre valid\\u00e9","title":"Validation de la campagne de contr\\u00f4le CDC-2023-01","transmitter":2}',
                'id' => 'bba63509-3bf9-4c28-8445-5e9dd2feba07',
                'notifiable_id' => 18,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2023-03-04 17:05:14',
                'type' => 'App\\Notifications\\ControlCampaign\\Created',
                'updated_at' => '2023-03-04 17:05:14',
            ),
            29 => 
            array (
                'created_at' => '2023-03-04 17:05:08',
                'data' => '{"id":1,"url":"http:\\/\\/127.0.0.1:8000\\/campaigns\\/1","content":"Nous vous informons qu\'une nouvelle campagne de contr\\u00f4le avec la r\\u00e9f\\u00e9rence CDC-2023-01 vient d\'\\u00eatre cr\\u00e9er","title":"Cr\\u00e9ation d\'une nouvelle campagne de contr\\u00f4le CDC-2023-01","transmitter":2}',
                'id' => 'bfc346ae-0f7d-4999-a1ee-84e14f004483',
                'notifiable_id' => 4,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => NULL,
                'type' => 'App\\Notifications\\ControlCampaign\\Created',
                'updated_at' => '2023-03-04 17:05:08',
            ),
            30 => 
            array (
                'created_at' => '2023-03-04 19:46:08',
                'data' => '{"id":"4a399675-dd14-4868-b727-183ef3525b9f","url":"http:\\/\\/127.0.0.1:8000\\/missions\\/4a399675-dd14-4868-b727-183ef3525b9f","content":"Une nouvelle mission avec la r\\u00e9f\\u00e9rence RAP202302\\/613 pour l\'agence 613 - Agence A\\u00e9roport HB vous a \\u00e9t\\u00e9 assign\\u00e9.","title":"Assignation de mission"}',
                'id' => 'e171a511-2863-4682-8c35-aa3937cd2aa0',
                'notifiable_id' => 19,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => NULL,
                'type' => 'App\\Notifications\\Mission\\Assigned',
                'updated_at' => '2023-03-04 19:46:08',
            ),
            31 => 
            array (
                'created_at' => '2023-03-04 17:05:08',
                'data' => '{"id":1,"url":"http:\\/\\/127.0.0.1:8000\\/campaigns\\/1","content":"Nous vous informons qu\'une nouvelle campagne de contr\\u00f4le avec la r\\u00e9f\\u00e9rence CDC-2023-01 vient d\'\\u00eatre cr\\u00e9er","title":"Cr\\u00e9ation d\'une nouvelle campagne de contr\\u00f4le CDC-2023-01","transmitter":2}',
                'id' => 'e449e32e-10f4-45cc-9d15-170aad9d08a4',
                'notifiable_id' => 13,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => NULL,
                'type' => 'App\\Notifications\\ControlCampaign\\Created',
                'updated_at' => '2023-03-04 17:05:08',
            ),
            32 => 
            array (
                'created_at' => '2023-03-04 19:19:50',
                'data' => '{"id":"4a399675-dd14-4868-b727-183ef3525b9f","url":"http:\\/\\/127.0.0.1:8000\\/missions\\/4a399675-dd14-4868-b727-183ef3525b9f","content":"Mission RAP202302\\/613 a \\u00e9t\\u00e9 r\\u00e9alis\\u00e9","title":"Mission RAP202302\\/613 valid\\u00e9e"}',
                'id' => 'e7e62b41-f799-4039-b7a2-07c122b56349',
                'notifiable_id' => 18,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2023-03-04 19:21:48',
                'type' => 'App\\Notifications\\Mission\\Validated',
                'updated_at' => '2023-03-04 19:21:48',
            ),
            33 => 
            array (
                'created_at' => '2023-03-04 17:03:51',
                'data' => '{"id":2,"url":"http:\\/\\/127.0.0.1:8000\\/campaigns\\/2","content":"Nous vous informons qu\'une nouvelle campagne de contr\\u00f4le avec la r\\u00e9f\\u00e9rence CDC-2023-02 vient d\'\\u00eatre cr\\u00e9er","title":"Cr\\u00e9ation d\'une nouvelle campagne de contr\\u00f4le CDC-2023-02","transmitter":2}',
                'id' => 'f04d7d24-0d62-48f5-893d-3e7741d0306c',
                'notifiable_id' => 5,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2023-03-04 17:05:43',
                'type' => 'App\\Notifications\\ControlCampaign\\Created',
                'updated_at' => '2023-03-04 17:05:43',
            ),
            34 => 
            array (
                'created_at' => '2023-03-04 17:05:08',
                'data' => '{"id":1,"url":"http:\\/\\/127.0.0.1:8000\\/campaigns\\/1","content":"Nous vous informons qu\'une nouvelle campagne de contr\\u00f4le avec la r\\u00e9f\\u00e9rence CDC-2023-01 vient d\'\\u00eatre cr\\u00e9er","title":"Cr\\u00e9ation d\'une nouvelle campagne de contr\\u00f4le CDC-2023-01","transmitter":2}',
                'id' => 'f0dd9376-5859-48eb-bab2-68f931766ff8',
                'notifiable_id' => 15,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => NULL,
                'type' => 'App\\Notifications\\ControlCampaign\\Created',
                'updated_at' => '2023-03-04 17:05:08',
            ),
            35 => 
            array (
                'created_at' => '2023-03-04 17:05:09',
                'data' => '{"id":1,"url":"http:\\/\\/127.0.0.1:8000\\/campaigns\\/1","content":"Nous vous informons qu\'une nouvelle campagne de contr\\u00f4le avec la r\\u00e9f\\u00e9rence CDC-2023-01 vient d\'\\u00eatre cr\\u00e9er","title":"Cr\\u00e9ation d\'une nouvelle campagne de contr\\u00f4le CDC-2023-01","transmitter":2}',
                'id' => 'f688d2c2-e2bc-4957-824a-5cb0b16c81c7',
                'notifiable_id' => 25,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => NULL,
                'type' => 'App\\Notifications\\ControlCampaign\\Created',
                'updated_at' => '2023-03-04 17:05:09',
            ),
            36 => 
            array (
                'created_at' => '2023-03-04 19:19:50',
                'data' => '{"id":"4a399675-dd14-4868-b727-183ef3525b9f","url":"http:\\/\\/127.0.0.1:8000\\/missions\\/4a399675-dd14-4868-b727-183ef3525b9f","content":"Mission RAP202302\\/613 a \\u00e9t\\u00e9 r\\u00e9alis\\u00e9","title":"Mission RAP202302\\/613 valid\\u00e9e"}',
                'id' => 'f703c795-8823-4076-b1c5-75e76977650b',
                'notifiable_id' => 2,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2023-03-04 19:20:10',
                'type' => 'App\\Notifications\\Mission\\Validated',
                'updated_at' => '2023-03-04 19:20:10',
            ),
            37 => 
            array (
                'created_at' => '2023-03-04 18:32:48',
                'data' => '{"id":"4a399675-dd14-4868-b727-183ef3525b9f","url":"http:\\/\\/127.0.0.1:8000\\/missions\\/4a399675-dd14-4868-b727-183ef3525b9f","content":"Mission 202302\\/613 a \\u00e9t\\u00e9 r\\u00e9alis\\u00e9","title":"Mission 202302\\/613 valid\\u00e9e"}',
                'id' => 'f8ec369d-d77c-4f89-9139-13e5c57e4943',
                'notifiable_id' => 5,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2023-03-04 18:34:16',
                'type' => 'App\\Notifications\\Mission\\Validated',
                'updated_at' => '2023-03-04 18:34:16',
            ),
            38 => 
            array (
                'created_at' => '2023-03-04 17:03:52',
                'data' => '{"id":2,"url":"http:\\/\\/127.0.0.1:8000\\/campaigns\\/2","content":"Nous vous informons qu\'une nouvelle campagne de contr\\u00f4le avec la r\\u00e9f\\u00e9rence CDC-2023-02 vient d\'\\u00eatre cr\\u00e9er","title":"Cr\\u00e9ation d\'une nouvelle campagne de contr\\u00f4le CDC-2023-02","transmitter":2}',
                'id' => 'fdbe765f-47bb-4d99-8f3f-6d8c3bc0ff20',
                'notifiable_id' => 25,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => NULL,
                'type' => 'App\\Notifications\\ControlCampaign\\Created',
                'updated_at' => '2023-03-04 17:03:52',
            ),
            39 => 
            array (
                'created_at' => '2023-03-04 17:05:08',
                'data' => '{"id":1,"url":"http:\\/\\/127.0.0.1:8000\\/campaigns\\/1","content":"Nous vous informons qu\'une nouvelle campagne de contr\\u00f4le avec la r\\u00e9f\\u00e9rence CDC-2023-01 vient d\'\\u00eatre cr\\u00e9er","title":"Cr\\u00e9ation d\'une nouvelle campagne de contr\\u00f4le CDC-2023-01","transmitter":2}',
                'id' => 'fe8a0eb2-48bb-4559-85a1-4784e0a31199',
                'notifiable_id' => 5,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => '2023-03-04 17:05:43',
                'type' => 'App\\Notifications\\ControlCampaign\\Created',
                'updated_at' => '2023-03-04 17:05:43',
            ),
        ));
        
        
    }
}