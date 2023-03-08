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
                'code' => 159,
                'id' => 1,
                'name' => 'DRE BISKRA',
            ),
            1 => 
            array (
                'code' => 180,
                'id' => 2,
                'name' => 'DRE BECHAR',
            ),
            2 => 
            array (
                'code' => 181,
                'id' => 3,
                'name' => 'DRE TLEMCEN',
            ),
            3 => 
            array (
                'code' => 182,
                'id' => 4,
                'name' => 'DRE ORAN',
            ),
            4 => 
            array (
                'code' => 183,
                'id' => 5,
                'name' => 'DRE TIZI OUZOU',
            ),
            5 => 
            array (
                'code' => 184,
                'id' => 6,
                'name' => 'DRE OUARGLA',
            ),
            6 => 
            array (
                'code' => 185,
                'id' => 7,
                'name' => 'DRE CONSTANTINE',
            ),
            7 => 
            array (
                'code' => 186,
                'id' => 8,
                'name' => 'DRE ANNABA',
            ),
            8 => 
            array (
                'code' => 187,
                'id' => 9,
                'name' => 'DRE GARIDI',
            ),
            9 => 
            array (
                'code' => 188,
                'id' => 10,
                'name' => 'DRE KOLEA',
            ),
            10 => 
            array (
                'code' => 189,
                'id' => 11,
                'name' => 'DRE BLIDA',
            ),
            11 => 
            array (
                'code' => 190,
                'id' => 12,
                'name' => 'DRE ROUIBA',
            ),
            12 => 
            array (
                'code' => 191,
                'id' => 13,
                'name' => 'DRE BOUIRA',
            ),
            13 => 
            array (
                'code' => 192,
                'id' => 14,
                'name' => 'DRE TEBESSA ',
            ),
            14 => 
            array (
                'code' => 194,
                'id' => 15,
                'name' => 'DRE BOUZAREAH',
            ),
            15 => 
            array (
                'code' => 195,
                'id' => 16,
                'name' => 'DRE EL BIAR',
            ),
            16 => 
            array (
                'code' => 196,
                'id' => 17,
                'name' => 'DRE CHLEF',
            ),
            17 => 
            array (
                'code' => 197,
                'id' => 18,
                'name' => 'DRE SETIF',
            ),
            18 => 
            array (
                'code' => 198,
                'id' => 19,
                'name' => 'DRE MOSTAGANEM',
            ),
            19 => 
            array (
                'code' => 199,
                'id' => 20,
                'name' => 'DRE SIDI BEL-ABBES',
            ),
        ));
        
        
    }
}