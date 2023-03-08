<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(RoleHasPermissionsTableSeeder::class);
        $this->call(UserHasRolesTableSeeder::class);
        $this->call(DresTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(AgenciesTableSeeder::class);
        $this->call(UserHasAgenciesTableSeeder::class);
        $this->call(FamilliesTableSeeder::class);
        $this->call(DomainsTableSeeder::class);
        $this->call(ProcessesTableSeeder::class);
        $this->call(CategoryHasProcessesTableSeeder::class);
        $this->call(ControlPointsTableSeeder::class);
        $this->call(AgencyHasExceptionalProcessesTableSeeder::class);

        // $this->call(ControlCampaignsTableSeeder::class);
        // $this->call(ControlCampaignProcessesTableSeeder::class);
        // $this->call(MissionsTableSeeder::class);
        // $this->call(MissionHasControllersTableSeeder::class);
        // $this->call(RegularizationsTableSeeder::class);
        // $this->call(MissionDetailsTableSeeder::class);
        // $this->call(MissionReportsTableSeeder::class);
        // $this->call(NotificationsTableSeeder::class);
        // $this->call(FailedJobsTableSeeder::class);
        // $this->call(MediaTableSeeder::class);
    }
}
