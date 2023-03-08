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
                'control_point_id' => 2609,
                'created_at' => '2023-03-04 17:08:09',
                'deleted_at' => NULL,
                'executed_at' => '2023-03-04 17:12:20',
                'id' => '00fcb4c5-7c42-40c2-8f0c-42f1b7f7ddd1',
                'major_fact' => 1,
                'major_fact_dispatched_at' => NULL,
                'metadata' => NULL,
                'mission_id' => '4a399675-dd14-4868-b727-183ef3525b9f',
                'processed_at' => NULL,
                'recovery_plan' => 'test',
                'regularization_id' => NULL,
                'report' => 'test',
                'score' => 4,
                'updated_at' => '2023-03-04 18:34:55',
                'validated_at' => '2023-03-04 18:34:55',
            ),
            1 => 
            array (
                'control_point_id' => 2613,
                'created_at' => '2023-03-04 17:08:09',
                'deleted_at' => NULL,
                'executed_at' => '2023-03-04 18:09:41',
                'id' => '237407de-8ed2-4e66-914b-2963ccf8a22d',
                'major_fact' => 0,
                'major_fact_dispatched_at' => NULL,
                'metadata' => NULL,
                'mission_id' => '4a399675-dd14-4868-b727-183ef3525b9f',
                'processed_at' => NULL,
                'recovery_plan' => NULL,
                'regularization_id' => NULL,
                'report' => NULL,
                'score' => 1,
                'updated_at' => '2023-03-04 18:34:55',
                'validated_at' => '2023-03-04 18:34:55',
            ),
            2 => 
            array (
                'control_point_id' => 2615,
                'created_at' => '2023-03-04 17:08:09',
                'deleted_at' => NULL,
                'executed_at' => '2023-03-04 18:09:41',
                'id' => '355ece57-eef7-4667-b634-8dc7263e6838',
                'major_fact' => 0,
                'major_fact_dispatched_at' => NULL,
                'metadata' => '[[{"label": "N° de compte bancaire", "rules": ["required"], "bank_account_number": "054548"}, {"label": "Constat", "rules": ["required"], "Constat": "trst"}], [{"label": "N° de compte bancaire", "rules": ["required"], "bank_account_number": "5488745"}, {"label": "Constat", "rules": ["required"], "Constat": "test"}], [{"label": "N° de compte bancaire", "rules": ["required"], "bank_account_number": "57854697"}, {"label": "Constat", "rules": ["required"], "Constat": "test"}]]',
                'mission_id' => '4a399675-dd14-4868-b727-183ef3525b9f',
                'processed_at' => NULL,
                'recovery_plan' => 'test',
                'regularization_id' => NULL,
                'report' => 'test',
                'score' => 4,
                'updated_at' => '2023-03-04 18:34:55',
                'validated_at' => '2023-03-04 18:34:55',
            ),
            3 => 
            array (
                'control_point_id' => 2610,
                'created_at' => '2023-03-04 17:08:09',
                'deleted_at' => NULL,
                'executed_at' => '2023-03-04 18:09:41',
                'id' => '4c0a83f7-3b19-4e44-839a-c761fcba1b98',
                'major_fact' => 0,
                'major_fact_dispatched_at' => NULL,
                'metadata' => NULL,
                'mission_id' => '4a399675-dd14-4868-b727-183ef3525b9f',
                'processed_at' => NULL,
                'recovery_plan' => 'test',
                'regularization_id' => NULL,
                'report' => 'test',
                'score' => 2,
                'updated_at' => '2023-03-04 18:34:55',
                'validated_at' => '2023-03-04 18:34:55',
            ),
            4 => 
            array (
                'control_point_id' => 2612,
                'created_at' => '2023-03-04 17:08:09',
                'deleted_at' => NULL,
                'executed_at' => '2023-03-04 18:09:41',
                'id' => '95ff6e64-ff25-4e6b-a708-d32aa3cabc92',
                'major_fact' => 0,
                'major_fact_dispatched_at' => NULL,
                'metadata' => NULL,
                'mission_id' => '4a399675-dd14-4868-b727-183ef3525b9f',
                'processed_at' => NULL,
                'recovery_plan' => 'dfdsfsd',
                'regularization_id' => NULL,
                'report' => 'tsdfds',
                'score' => 3,
                'updated_at' => '2023-03-04 18:34:55',
                'validated_at' => '2023-03-04 18:34:55',
            ),
            5 => 
            array (
                'control_point_id' => 2614,
                'created_at' => '2023-03-04 17:08:09',
                'deleted_at' => NULL,
                'executed_at' => '2023-03-04 18:09:41',
                'id' => 'ae5cec02-93f2-490e-a0ed-24b7c0891f11',
                'major_fact' => 0,
                'major_fact_dispatched_at' => NULL,
                'metadata' => NULL,
                'mission_id' => '4a399675-dd14-4868-b727-183ef3525b9f',
                'processed_at' => NULL,
                'recovery_plan' => NULL,
                'regularization_id' => NULL,
                'report' => NULL,
                'score' => 1,
                'updated_at' => '2023-03-04 18:34:55',
                'validated_at' => '2023-03-04 18:34:55',
            ),
            6 => 
            array (
                'control_point_id' => 2608,
                'created_at' => '2023-03-04 17:08:09',
                'deleted_at' => NULL,
                'executed_at' => '2023-03-04 17:12:20',
                'id' => 'aefa7b56-7201-4fe9-8afb-e74c5aef80e0',
                'major_fact' => 0,
                'major_fact_dispatched_at' => NULL,
                'metadata' => NULL,
                'mission_id' => '4a399675-dd14-4868-b727-183ef3525b9f',
                'processed_at' => NULL,
                'recovery_plan' => 'test',
                'regularization_id' => NULL,
                'report' => 'test',
                'score' => 3,
                'updated_at' => '2023-03-04 18:34:55',
                'validated_at' => '2023-03-04 18:34:55',
            ),
            7 => 
            array (
                'control_point_id' => 2611,
                'created_at' => '2023-03-04 17:08:09',
                'deleted_at' => NULL,
                'executed_at' => '2023-03-04 18:09:41',
                'id' => 'b0943784-15a4-45e3-81d8-e7c1bae671e0',
                'major_fact' => 0,
                'major_fact_dispatched_at' => NULL,
                'metadata' => '[[{"label": "N° de compte bancaire", "rules": ["required"], "bank_account_number": "54875487"}, {"label": "Constat", "rules": ["required"], "Constat": "test"}]]',
                'mission_id' => '4a399675-dd14-4868-b727-183ef3525b9f',
                'processed_at' => NULL,
                'recovery_plan' => 'tezt',
                'regularization_id' => NULL,
                'report' => 'test',
                'score' => 3,
                'updated_at' => '2023-03-04 18:34:55',
                'validated_at' => '2023-03-04 18:34:55',
            ),
        ));
        
        
    }
}