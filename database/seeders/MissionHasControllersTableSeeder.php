<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MissionHasControllersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('mission_has_controllers')->delete();
        
        \DB::table('mission_has_controllers')->insert(array (
            0 => 
            array (
                'control_agency' => 0,
                'mission_id' => '4a399675-dd14-4868-b727-183ef3525b9f',
                'user_id' => 19,
            ),
        ));
        
        
    }
}