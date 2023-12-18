<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdateMissionDetailRegularizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            $regularizations = DB::table('mission_detail_regularizations AS mdr')->select([
                'mdr.id',
                DB::raw("CONCAT(u.first_name, ' ', u.last_name) AS fk_creator_full_name"),
            ])->leftJoin('users AS u', 'u.id', 'mdr.created_by_id')
                ->groupBy([
                    'u.first_name',
                    'u.last_name',
                    'mdr.id',
                ]);
            $regularizations = $regularizations->get();
            foreach ($regularizations as $regularization) {
                DB::table('mission_detail_regularizations')->where('id', $regularization->id)->update([
                    'creator_full_name' => $regularization->fk_creator_full_name
                ]);
            }
        });
    }
}