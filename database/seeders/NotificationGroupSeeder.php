<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotificationGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            DB::table('notification_groups')->delete();

            DB::table('notification_groups')->insert([
                [
                    'code' => 'control_campaigns',
                    'label' => 'Campagnes de contrôle',
                ],
                [
                    'code' => 'missions',
                    'label' => 'Missions',
                ],
                [
                    'code' => 'major_facts',
                    'label' => 'Faits majeurs',
                ],
            ]);
        });
    }
}
