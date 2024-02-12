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
            $regularizations = DB::table('mission_detail_regularizations')->get();
            foreach ($regularizations as $regularization) {
                DB::table('mission_detail_regularizations')->where('id', $regularization->id)->update([
                    'creator_full_name' => getUserFullNameWithRole($regularization->created_by_id),
                ]);
            }
        });
    }
}
