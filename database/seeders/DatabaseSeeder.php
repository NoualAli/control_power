<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
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
        // $this->call(PermissionsTableSeeder::class);
        // $this->call(UsersTableSeeder::class);
        $this->call(UserHasNotificationsSeeder::class);
        // $this->call(MissionsTableSeeder::class);
        // $this->call(MediaTableSeeder::class);
        // Schema::dropIfExists('websockets_statistics_entries');
    }
}