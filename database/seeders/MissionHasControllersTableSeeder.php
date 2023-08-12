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
                'user_id' => 45,
                'mission_id' => 'a515650d-1702-4236-a439-4944783ac815',
                'control_agency' => 1,
            ),
        ));
        
        
    }
}