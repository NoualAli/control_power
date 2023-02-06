<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DresTableSeeder::class);
        $this->call(AgenciesTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(RoleHasPermissionsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(UserHasRolesTableSeeder::class);
        $this->call(UserHasDresTableSeeder::class);
        $this->call(FamilliesTableSeeder::class);
        $this->call(DomainsTableSeeder::class);
        $this->call(ProcessesTableSeeder::class);
        $this->call(ControlPointsTableSeeder::class);
        $this->call(ControlCampaignsTableSeeder::class);
        $this->call(ControlCampaignProcessesTableSeeder::class);
        $this->call(MissionsTableSeeder::class);
        $this->call(MissionHasControllersTableSeeder::class);
        $this->call(MissionDetailsTableSeeder::class);
        $this->call(MissionReportsTableSeeder::class);
    }
}
