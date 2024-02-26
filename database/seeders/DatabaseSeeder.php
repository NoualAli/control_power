<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // $this->call(NotificationGroupSeeder::class);
        // $this->call(NotificationTypeSeeder::class);
        $this->call(UserHasNotificationsSeeder::class);
        // $this->call(MissionsTableSeeder::class);
        // $this->call(UpdateControlCampaignsTable::class);
        $this->call(MediaTableSeeder::class);
        // $this->call(FieldsTableSeeder::class);
        // $this->call(MissionDetailsTableSeeder::class);
        // $this->call(MissionDetailMetadataSeeder::class);
        // $this->call(UpdateMissionDetailRegularizationSeeder::class);
        // $this->call(PermissionsTableSeeder::class);
        // $this->call(NotificationsTableSeeder::class);
    }
}
