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
                'user_id' => 14,
                'mission_id' => 'a480f9e4-7752-41d1-8654-ffca1fe2fac7',
            ),
            1 => 
            array (
                'user_id' => 14,
                'mission_id' => 'b0638002-dc07-45b4-a9c8-f9b67d62c348',
            ),
            2 => 
            array (
                'user_id' => 14,
                'mission_id' => '25222f9d-cd36-4b05-8877-b4d2b1e0aa6b',
            ),
        ));
        
        
    }
}