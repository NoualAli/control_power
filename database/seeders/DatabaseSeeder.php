<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(MediaTableSeeder::class);
        $this->call(FieldsTableSeeder::class);
        $this->call(MissionDetailMetadataSeeder::class);
        $this->call(PermissionsTableSeeder::class);
    }
}
