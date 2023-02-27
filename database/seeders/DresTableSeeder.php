<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DresTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('dres')->delete();
        
        \DB::table('dres')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'DRE BISKRA',
                'code' => 159,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'DRE BECHAR',
                'code' => 180,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'DRE TLEMCEN',
                'code' => 181,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'DRE ORAN',
                'code' => 182,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'DRE TIZI OUZOU',
                'code' => 183,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'DRE OUARGLA',
                'code' => 184,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'DRE CONSTANTINE',
                'code' => 185,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'DRE ANNABA',
                'code' => 186,
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'DRE GARIDI',
                'code' => 187,
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'DRE KOLEA',
                'code' => 188,
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'DRE BLIDA',
                'code' => 189,
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'DRE ROUIBA',
                'code' => 190,
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'DRE BOUIRA',
                'code' => 191,
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'DRE TEBESSA ',
                'code' => 192,
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'DRE BOUZAREAH',
                'code' => 194,
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'DRE EL BIAR',
                'code' => 195,
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'DRE CHLEF',
                'code' => 196,
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'DRE SETIF',
                'code' => 197,
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'DRE MOSTAGANEM',
                'code' => 198,
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'DRE SIDI BEL-ABBES',
                'code' => 199,
            ),
        ));
        
        
    }
}