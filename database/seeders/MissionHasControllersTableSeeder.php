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
                'user_id' => '45',
                'mission_id' => 'A515650D-1702-4236-A439-4944783AC815',
                'control_agency' => '1',
            ),
            1 => 
            array (
                'user_id' => '45',
                'mission_id' => 'FA60045C-C4FD-457F-905E-5DB6D5260066',
                'control_agency' => '1',
            ),
        ));
        
        
    }
}