<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AgencyHasExceptionalProcessesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('agency_has_exceptional_processes')->delete();
        
        \DB::table('agency_has_exceptional_processes')->insert(array (
            0 => 
            array (
                'agency_id' => 105,
                'process_id' => 103,
                'is_usable' => 1,
            ),
            1 => 
            array (
                'agency_id' => 105,
                'process_id' => 104,
                'is_usable' => 1,
            ),
            2 => 
            array (
                'agency_id' => 105,
                'process_id' => 105,
                'is_usable' => 1,
            ),
            3 => 
            array (
                'agency_id' => 105,
                'process_id' => 106,
                'is_usable' => 1,
            ),
            4 => 
            array (
                'agency_id' => 105,
                'process_id' => 107,
                'is_usable' => 1,
            ),
            5 => 
            array (
                'agency_id' => 105,
                'process_id' => 108,
                'is_usable' => 1,
            ),
            6 => 
            array (
                'agency_id' => 105,
                'process_id' => 109,
                'is_usable' => 1,
            ),
            7 => 
            array (
                'agency_id' => 105,
                'process_id' => 56,
                'is_usable' => 0,
            ),
            8 => 
            array (
                'agency_id' => 105,
                'process_id' => 57,
                'is_usable' => 0,
            ),
            9 => 
            array (
                'agency_id' => 103,
                'process_id' => 103,
                'is_usable' => 1,
            ),
            10 => 
            array (
                'agency_id' => 103,
                'process_id' => 104,
                'is_usable' => 1,
            ),
            11 => 
            array (
                'agency_id' => 103,
                'process_id' => 105,
                'is_usable' => 1,
            ),
            12 => 
            array (
                'agency_id' => 103,
                'process_id' => 106,
                'is_usable' => 1,
            ),
            13 => 
            array (
                'agency_id' => 103,
                'process_id' => 107,
                'is_usable' => 1,
            ),
            14 => 
            array (
                'agency_id' => 103,
                'process_id' => 108,
                'is_usable' => 1,
            ),
            15 => 
            array (
                'agency_id' => 103,
                'process_id' => 109,
                'is_usable' => 1,
            ),
            16 => 
            array (
                'agency_id' => 103,
                'process_id' => 110,
                'is_usable' => 0,
            ),
            17 => 
            array (
                'agency_id' => 103,
                'process_id' => 111,
                'is_usable' => 0,
            ),
            18 => 
            array (
                'agency_id' => 103,
                'process_id' => 112,
                'is_usable' => 0,
            ),
            19 => 
            array (
                'agency_id' => 103,
                'process_id' => 113,
                'is_usable' => 0,
            ),
            20 => 
            array (
                'agency_id' => 103,
                'process_id' => 114,
                'is_usable' => 0,
            ),
            21 => 
            array (
                'agency_id' => 103,
                'process_id' => 115,
                'is_usable' => 0,
            ),
            22 => 
            array (
                'agency_id' => 103,
                'process_id' => 116,
                'is_usable' => 0,
            ),
            23 => 
            array (
                'agency_id' => 103,
                'process_id' => 117,
                'is_usable' => 0,
            ),
        ));
        
        
    }
}