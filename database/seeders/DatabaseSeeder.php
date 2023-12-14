<?php

namespace Database\Seeders;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

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
        $this->call(MissionsTableSeeder::class);
        $this->call(UpdateControlCampaignsTable::class);
        $this->call(MediaTableSeeder::class);
        $this->call(FieldsTableSeeder::class);
        $this->call(MissionDetailsTableSeeder::class);
        $this->call(MissionDetailMetadataSeeder::class);
        $this->call(PermissionsTableSeeder::class);
    }
}
