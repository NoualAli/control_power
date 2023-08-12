<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MissionDetailsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('mission_details')->delete();
        
        \DB::table('mission_details')->insert(array (
            0 => 
            array (
                'id' => '0737b2a8-61ec-48ca-8f16-fa5bd8c0cdbe',
                'control_point_id' => 36,
                'mission_id' => 'a515650d-1702-4236-a439-4944783ac815',
                'ci_report' => '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.</p>',
                'cdc_report' => NULL,
                'recovery_plan' => NULL,
                'score' => 1,
                'major_fact' => 0,
                'metadata' => NULL,
                'assigned_to_ci_id' => NULL,
                'assigned_to_cc_id' => NULL,
                'controlled_by_ci_id' => 45,
                'controlled_by_cc_id' => NULL,
                'controlled_at' => '2023-07-30 12:08:23',
                'major_fact_dispatched_at' => NULL,
                'created_at' => '2023-07-30 11:49:42',
                'updated_at' => '2023-07-30 12:08:23',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => '0a5346d3-9d36-4a0c-aed0-097cbf0cb1fb',
                'control_point_id' => 43,
                'mission_id' => 'a515650d-1702-4236-a439-4944783ac815',
                'ci_report' => '<p class="ql-align-justify">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock</p>',
                'cdc_report' => NULL,
                'recovery_plan' => NULL,
                'score' => 1,
                'major_fact' => 0,
                'metadata' => NULL,
                'assigned_to_ci_id' => NULL,
                'assigned_to_cc_id' => NULL,
                'controlled_by_ci_id' => 45,
                'controlled_by_cc_id' => NULL,
                'controlled_at' => '2023-07-30 12:10:53',
                'major_fact_dispatched_at' => NULL,
                'created_at' => '2023-07-30 11:49:42',
                'updated_at' => '2023-07-30 12:10:53',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => '0d6a2f62-5be1-4e23-980c-46e67a069003',
                'control_point_id' => 225,
                'mission_id' => 'a515650d-1702-4236-a439-4944783ac815',
                'ci_report' => '<p class="ql-align-justify">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>',
                'cdc_report' => NULL,
                'recovery_plan' => '<p class="ql-align-justify">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>',
                'score' => 3,
                'major_fact' => 0,
                'metadata' => NULL,
                'assigned_to_ci_id' => NULL,
                'assigned_to_cc_id' => NULL,
                'controlled_by_ci_id' => 45,
                'controlled_by_cc_id' => NULL,
                'controlled_at' => '2023-07-30 12:12:46',
                'major_fact_dispatched_at' => NULL,
                'created_at' => '2023-07-30 11:49:42',
                'updated_at' => '2023-07-30 12:12:46',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => '2fe98d6f-13f5-4e83-8685-f1d8dc39a225',
                'control_point_id' => 44,
                'mission_id' => 'a515650d-1702-4236-a439-4944783ac815',
            'ci_report' => '<p class="ql-align-justify">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>',
                'cdc_report' => NULL,
            'recovery_plan' => '<p class="ql-align-justify">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>',
                'score' => 3,
                'major_fact' => 0,
            'metadata' => '[[{"label": "Journée de comptabilisation", "rules": ["required", "date"], "accounting_day": "2023-07-06"}, {"label": "Constat", "rules": ["required"], "Constat": "Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered"}], [{"label": "Journée de comptabilisation", "rules": ["required", "date"], "accounting_day": "2023-07-07"}, {"label": "Constat", "rules": ["required"], "Constat": "Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \\"de Finibus Bonorum et Malorum\\" (The Extremes of Good and Evil) b"}], [{"label": "Journée de comptabilisation", "rules": ["required", "date"], "accounting_day": "2023-06-26"}, {"label": "Constat", "rules": ["required"], "Constat": "Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \\"de Finibus Bonorum et Malorum\\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum,"}]]',
                'assigned_to_ci_id' => NULL,
                'assigned_to_cc_id' => NULL,
                'controlled_by_ci_id' => 45,
                'controlled_by_cc_id' => NULL,
                'controlled_at' => '2023-07-30 12:11:43',
                'major_fact_dispatched_at' => NULL,
                'created_at' => '2023-07-30 11:49:42',
                'updated_at' => '2023-07-30 12:11:43',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => '3b73cd7c-dba9-4dcf-b91a-23f1a992a13c',
                'control_point_id' => 482,
                'mission_id' => 'a515650d-1702-4236-a439-4944783ac815',
                'ci_report' => '<p class="ql-align-justify">Contrary to popular belief, Lorem Ipsum is not simply random text.</p>',
                'cdc_report' => NULL,
                'recovery_plan' => NULL,
                'score' => 1,
                'major_fact' => 0,
                'metadata' => NULL,
                'assigned_to_ci_id' => NULL,
                'assigned_to_cc_id' => NULL,
                'controlled_by_ci_id' => 45,
                'controlled_by_cc_id' => NULL,
                'controlled_at' => '2023-07-30 12:09:17',
                'major_fact_dispatched_at' => NULL,
                'created_at' => '2023-07-30 11:49:42',
                'updated_at' => '2023-07-30 12:09:17',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => '3f0f923b-b8c0-446b-a64c-9b97bee5f6b7',
                'control_point_id' => 232,
                'mission_id' => 'a515650d-1702-4236-a439-4944783ac815',
                'ci_report' => '<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of</p>',
                'cdc_report' => NULL,
                'recovery_plan' => NULL,
                'score' => 1,
                'major_fact' => 0,
                'metadata' => NULL,
                'assigned_to_ci_id' => NULL,
                'assigned_to_cc_id' => NULL,
                'controlled_by_ci_id' => 45,
                'controlled_by_cc_id' => NULL,
                'controlled_at' => '2023-07-30 12:15:29',
                'major_fact_dispatched_at' => NULL,
                'created_at' => '2023-07-30 11:49:42',
                'updated_at' => '2023-07-30 12:15:29',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => '4105606f-63a0-402e-ad7a-13a91d9e64ae',
                'control_point_id' => 484,
                'mission_id' => 'a515650d-1702-4236-a439-4944783ac815',
                'ci_report' => '<p class="ql-align-justify">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.</p>',
                'cdc_report' => NULL,
                'recovery_plan' => NULL,
                'score' => 1,
                'major_fact' => 0,
                'metadata' => NULL,
                'assigned_to_ci_id' => NULL,
                'assigned_to_cc_id' => NULL,
                'controlled_by_ci_id' => 45,
                'controlled_by_cc_id' => NULL,
                'controlled_at' => '2023-07-30 12:09:31',
                'major_fact_dispatched_at' => NULL,
                'created_at' => '2023-07-30 11:49:42',
                'updated_at' => '2023-07-30 12:09:31',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => '5859cd2a-ff26-4546-8cc0-15cef55d840e',
                'control_point_id' => 230,
                'mission_id' => 'a515650d-1702-4236-a439-4944783ac815',
                'ci_report' => '<p class="ql-align-justify">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>',
                'cdc_report' => NULL,
                'recovery_plan' => '<p class="ql-align-justify">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>',
                'score' => 4,
                'major_fact' => 0,
                'metadata' => '[[{"label": "N° de compte bancaire", "rules": ["required"], "bank_account_number": "5487946468"}, {"label": "Constat", "rules": ["required"], "Constat": "There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model s"}], [{"label": "N° de compte bancaire", "rules": ["required"], "bank_account_number": "326464564865"}, {"label": "Constat", "rules": ["required"], "Constat": "There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model"}], [{"label": "N° de compte bancaire", "rules": ["required"], "bank_account_number": "12464561894"}, {"label": "Constat", "rules": ["required"], "Constat": "There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition"}]]',
                'assigned_to_ci_id' => NULL,
                'assigned_to_cc_id' => NULL,
                'controlled_by_ci_id' => 45,
                'controlled_by_cc_id' => NULL,
                'controlled_at' => '2023-07-30 12:15:04',
                'major_fact_dispatched_at' => NULL,
                'created_at' => '2023-07-30 11:49:42',
                'updated_at' => '2023-07-30 12:15:04',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => '61534dd6-d343-4fc7-abc2-19dd50e9f625',
                'control_point_id' => 39,
                'mission_id' => 'a515650d-1702-4236-a439-4944783ac815',
                'ci_report' => '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia,</p>',
                'cdc_report' => NULL,
                'recovery_plan' => NULL,
                'score' => 1,
                'major_fact' => 0,
                'metadata' => NULL,
                'assigned_to_ci_id' => NULL,
                'assigned_to_cc_id' => NULL,
                'controlled_by_ci_id' => 45,
                'controlled_by_cc_id' => NULL,
                'controlled_at' => '2023-07-30 12:09:54',
                'major_fact_dispatched_at' => NULL,
                'created_at' => '2023-07-30 11:49:42',
                'updated_at' => '2023-07-30 12:09:54',
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => '63bf29b8-3df6-4336-b960-4d481aa70248',
                'control_point_id' => 231,
                'mission_id' => 'a515650d-1702-4236-a439-4944783ac815',
                'ci_report' => '<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form,</p>',
                'cdc_report' => NULL,
                'recovery_plan' => NULL,
                'score' => 1,
                'major_fact' => 0,
                'metadata' => NULL,
                'assigned_to_ci_id' => NULL,
                'assigned_to_cc_id' => NULL,
                'controlled_by_ci_id' => 45,
                'controlled_by_cc_id' => NULL,
                'controlled_at' => '2023-07-30 12:15:13',
                'major_fact_dispatched_at' => NULL,
                'created_at' => '2023-07-30 11:49:42',
                'updated_at' => '2023-07-30 12:15:13',
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => '7c572204-8d55-47e4-bd5b-df8bd3d711b4',
                'control_point_id' => 34,
                'mission_id' => 'a515650d-1702-4236-a439-4944783ac815',
                'ci_report' => '<p class="ql-align-justify">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.</p>',
                'cdc_report' => NULL,
                'recovery_plan' => '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words,</p>',
                'score' => 4,
                'major_fact' => 0,
                'metadata' => NULL,
                'assigned_to_ci_id' => NULL,
                'assigned_to_cc_id' => NULL,
                'controlled_by_ci_id' => 45,
                'controlled_by_cc_id' => NULL,
                'controlled_at' => '2023-07-30 12:06:37',
                'major_fact_dispatched_at' => NULL,
                'created_at' => '2023-07-30 11:49:42',
                'updated_at' => '2023-07-30 12:06:37',
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => '890c7613-8ef1-4dcf-8416-5684dcd63e35',
                'control_point_id' => 40,
                'mission_id' => 'a515650d-1702-4236-a439-4944783ac815',
                'ci_report' => '<p class="ql-align-justify">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock</p>',
                'cdc_report' => NULL,
                'recovery_plan' => NULL,
                'score' => 1,
                'major_fact' => 0,
                'metadata' => NULL,
                'assigned_to_ci_id' => NULL,
                'assigned_to_cc_id' => NULL,
                'controlled_by_ci_id' => 45,
                'controlled_by_cc_id' => NULL,
                'controlled_at' => '2023-07-30 12:10:05',
                'major_fact_dispatched_at' => NULL,
                'created_at' => '2023-07-30 11:49:42',
                'updated_at' => '2023-07-30 12:10:05',
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => '99fef425-0334-402b-8233-c7bf66ef8ae3',
                'control_point_id' => 42,
                'mission_id' => 'a515650d-1702-4236-a439-4944783ac815',
                'ci_report' => '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words</p>',
                'cdc_report' => NULL,
                'recovery_plan' => NULL,
                'score' => 1,
                'major_fact' => 0,
                'metadata' => NULL,
                'assigned_to_ci_id' => NULL,
                'assigned_to_cc_id' => NULL,
                'controlled_by_ci_id' => 45,
                'controlled_by_cc_id' => NULL,
                'controlled_at' => '2023-07-30 12:10:36',
                'major_fact_dispatched_at' => NULL,
                'created_at' => '2023-07-30 11:49:42',
                'updated_at' => '2023-07-30 12:10:36',
                'deleted_at' => NULL,
            ),
            13 => 
            array (
                'id' => 'a2b82b60-dc57-4551-ad02-ecc619676501',
                'control_point_id' => 229,
                'mission_id' => 'a515650d-1702-4236-a439-4944783ac815',
                'ci_report' => '<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form,</p>',
                'cdc_report' => NULL,
                'recovery_plan' => NULL,
                'score' => 1,
                'major_fact' => 0,
                'metadata' => NULL,
                'assigned_to_ci_id' => NULL,
                'assigned_to_cc_id' => NULL,
                'controlled_by_ci_id' => 45,
                'controlled_by_cc_id' => NULL,
                'controlled_at' => '2023-07-30 12:14:30',
                'major_fact_dispatched_at' => NULL,
                'created_at' => '2023-07-30 11:49:42',
                'updated_at' => '2023-07-30 12:14:30',
                'deleted_at' => NULL,
            ),
            14 => 
            array (
                'id' => 'a55e1b56-c9a5-4db3-9571-aae3e3581e4d',
                'control_point_id' => 226,
                'mission_id' => 'a515650d-1702-4236-a439-4944783ac815',
                'ci_report' => '<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of</p>',
                'cdc_report' => NULL,
                'recovery_plan' => NULL,
                'score' => 1,
                'major_fact' => 0,
                'metadata' => NULL,
                'assigned_to_ci_id' => NULL,
                'assigned_to_cc_id' => NULL,
                'controlled_by_ci_id' => 45,
                'controlled_by_cc_id' => NULL,
                'controlled_at' => '2023-07-30 12:12:55',
                'major_fact_dispatched_at' => NULL,
                'created_at' => '2023-07-30 11:49:42',
                'updated_at' => '2023-07-30 12:12:55',
                'deleted_at' => NULL,
            ),
            15 => 
            array (
                'id' => 'b1368d0b-73b2-4792-8bb7-1df0477c5fad',
                'control_point_id' => 227,
                'mission_id' => 'a515650d-1702-4236-a439-4944783ac815',
                'ci_report' => '<p class="ql-align-justify">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>',
                'cdc_report' => NULL,
                'recovery_plan' => '<p class="ql-align-justify">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>',
                'score' => 2,
                'major_fact' => 0,
                'metadata' => NULL,
                'assigned_to_ci_id' => NULL,
                'assigned_to_cc_id' => NULL,
                'controlled_by_ci_id' => 45,
                'controlled_by_cc_id' => NULL,
                'controlled_at' => '2023-07-30 12:14:05',
                'major_fact_dispatched_at' => NULL,
                'created_at' => '2023-07-30 11:49:42',
                'updated_at' => '2023-07-30 12:14:05',
                'deleted_at' => NULL,
            ),
            16 => 
            array (
                'id' => 'b178dea1-4ff2-4564-9681-96ee70d59a40',
                'control_point_id' => 41,
                'mission_id' => 'a515650d-1702-4236-a439-4944783ac815',
                'ci_report' => '<p class="ql-align-justify">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words,</p>',
                'cdc_report' => NULL,
            'recovery_plan' => '<p class="ql-align-justify">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>',
                'score' => 4,
                'major_fact' => 0,
                'metadata' => NULL,
                'assigned_to_ci_id' => NULL,
                'assigned_to_cc_id' => NULL,
                'controlled_by_ci_id' => 45,
                'controlled_by_cc_id' => NULL,
                'controlled_at' => '2023-07-30 12:10:21',
                'major_fact_dispatched_at' => NULL,
                'created_at' => '2023-07-30 11:49:42',
                'updated_at' => '2023-07-30 12:10:21',
                'deleted_at' => NULL,
            ),
            17 => 
            array (
                'id' => 'bb683238-16ca-4048-aa8b-e549097645d3',
                'control_point_id' => 45,
                'mission_id' => 'a515650d-1702-4236-a439-4944783ac815',
                'ci_report' => '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of</p>',
                'cdc_report' => NULL,
                'recovery_plan' => '<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of</p>',
                'score' => 2,
                'major_fact' => 0,
                'metadata' => NULL,
                'assigned_to_ci_id' => NULL,
                'assigned_to_cc_id' => NULL,
                'controlled_by_ci_id' => 45,
                'controlled_by_cc_id' => NULL,
                'controlled_at' => '2023-07-30 12:12:10',
                'major_fact_dispatched_at' => NULL,
                'created_at' => '2023-07-30 11:49:42',
                'updated_at' => '2023-07-30 12:12:10',
                'deleted_at' => NULL,
            ),
            18 => 
            array (
                'id' => 'c0ba854c-cffe-4d1d-93d0-3fc0a389ed7e',
                'control_point_id' => 228,
                'mission_id' => 'a515650d-1702-4236-a439-4944783ac815',
                'ci_report' => '<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form,</p>',
                'cdc_report' => NULL,
                'recovery_plan' => NULL,
                'score' => 1,
                'major_fact' => 0,
                'metadata' => NULL,
                'assigned_to_ci_id' => NULL,
                'assigned_to_cc_id' => NULL,
                'controlled_by_ci_id' => 45,
                'controlled_by_cc_id' => NULL,
                'controlled_at' => '2023-07-30 12:14:21',
                'major_fact_dispatched_at' => NULL,
                'created_at' => '2023-07-30 11:49:42',
                'updated_at' => '2023-07-30 12:14:21',
                'deleted_at' => NULL,
            ),
            19 => 
            array (
                'id' => 'edf90f48-2ede-412c-a193-26d717856872',
                'control_point_id' => 38,
                'mission_id' => 'a515650d-1702-4236-a439-4944783ac815',
                'ci_report' => '<p class="ql-align-justify">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words</p>',
                'cdc_report' => NULL,
            'recovery_plan' => '<p class="ql-align-justify">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>',
                'score' => 4,
                'major_fact' => 0,
                'metadata' => NULL,
                'assigned_to_ci_id' => NULL,
                'assigned_to_cc_id' => NULL,
                'controlled_by_ci_id' => 45,
                'controlled_by_cc_id' => NULL,
                'controlled_at' => '2023-07-30 12:09:00',
                'major_fact_dispatched_at' => NULL,
                'created_at' => '2023-07-30 11:49:42',
                'updated_at' => '2023-07-30 12:09:00',
                'deleted_at' => NULL,
            ),
            20 => 
            array (
                'id' => 'f581f311-0d85-4769-8eac-2f538df43d30',
                'control_point_id' => 35,
                'mission_id' => 'a515650d-1702-4236-a439-4944783ac815',
            'ci_report' => '<p class="ql-align-justify">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>',
                'cdc_report' => NULL,
                'recovery_plan' => NULL,
                'score' => 1,
                'major_fact' => 0,
                'metadata' => NULL,
                'assigned_to_ci_id' => NULL,
                'assigned_to_cc_id' => NULL,
                'controlled_by_ci_id' => 45,
                'controlled_by_cc_id' => NULL,
                'controlled_at' => '2023-07-30 12:08:03',
                'major_fact_dispatched_at' => NULL,
                'created_at' => '2023-07-30 11:49:42',
                'updated_at' => '2023-07-30 12:08:03',
                'deleted_at' => NULL,
            ),
            21 => 
            array (
                'id' => 'f698de98-9a20-43c1-91bc-d0826f24cf7a',
                'control_point_id' => 37,
                'mission_id' => 'a515650d-1702-4236-a439-4944783ac815',
                'ci_report' => '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from</p>',
                'cdc_report' => NULL,
                'recovery_plan' => NULL,
                'score' => 1,
                'major_fact' => 0,
                'metadata' => NULL,
                'assigned_to_ci_id' => NULL,
                'assigned_to_cc_id' => NULL,
                'controlled_by_ci_id' => 45,
                'controlled_by_cc_id' => NULL,
                'controlled_at' => '2023-07-30 12:08:37',
                'major_fact_dispatched_at' => NULL,
                'created_at' => '2023-07-30 11:49:42',
                'updated_at' => '2023-07-30 12:08:37',
                'deleted_at' => NULL,
            ),
            22 => 
            array (
                'id' => 'fa0f5665-b7e5-401c-9a57-26a46330fb4d',
                'control_point_id' => 483,
                'mission_id' => 'a515650d-1702-4236-a439-4944783ac815',
                'ci_report' => '<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of</p>',
                'cdc_report' => NULL,
                'recovery_plan' => NULL,
                'score' => 1,
                'major_fact' => 0,
                'metadata' => NULL,
                'assigned_to_ci_id' => NULL,
                'assigned_to_cc_id' => NULL,
                'controlled_by_ci_id' => 45,
                'controlled_by_cc_id' => NULL,
                'controlled_at' => '2023-07-30 12:12:25',
                'major_fact_dispatched_at' => NULL,
                'created_at' => '2023-07-30 11:49:42',
                'updated_at' => '2023-07-30 12:12:25',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}