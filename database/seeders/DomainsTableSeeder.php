<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DomainsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('domains')->delete();
        
        \DB::table('domains')->insert(array (
            0 => 
            array (
                'familly_id' => 1,
                'id' => 1,
                'name' => 'E-Banking',
            ),
            1 => 
            array (
                'familly_id' => 1,
                'id' => 2,
                'name' => 'Opérations de change manuel',
            ),
            2 => 
            array (
                'familly_id' => 1,
                'id' => 3,
                'name' => 'Comptes clientèles ',
            ),
            3 => 
            array (
                'familly_id' => 1,
                'id' => 4,
                'name' => 'Opérations de caisse - retrait et versement',
            ),
            4 => 
            array (
                'familly_id' => 1,
                'id' => 5,
                'name' => 'Monétique',
            ),
            5 => 
            array (
                'familly_id' => 1,
                'id' => 6,
                'name' => 'Bons de caisse',
            ),
            6 => 
            array (
                'familly_id' => 1,
                'id' => 7,
                'name' => 'DAT',
            ),
            7 => 
            array (
                'familly_id' => 1,
                'id' => 8,
                'name' => 'Gestion des valeurs',
            ),
            8 => 
            array (
                'familly_id' => 1,
                'id' => 9,
                'name' => 'Juridique',
            ),
            9 => 
            array (
                'familly_id' => 1,
                'id' => 10,
                'name' => 'Arreté de caisse et gestion des encaisses',
            ),
            10 => 
            array (
                'familly_id' => 1,
                'id' => 11,
                'name' => 'instruments de paiements',
            ),
            11 => 
            array (
                'familly_id' => 2,
                'id' => 12,
                'name' => 'crédit Auto',
            ),
            12 => 
            array (
                'familly_id' => 2,
                'id' => 13,
                'name' => 'crédit confort',
            ),
            13 => 
            array (
                'familly_id' => 2,
                'id' => 14,
                'name' => 'crédit immobilier',
            ),
            14 => 
            array (
                'familly_id' => 2,
                'id' => 15,
                'name' => 'crédit location',
            ),
            15 => 
            array (
                'familly_id' => 2,
                'id' => 16,
                'name' => 'crédits - investissement',
            ),
            16 => 
            array (
                'familly_id' => 2,
                'id' => 17,
                'name' => 'crédits - professionnel',
            ),
            17 => 
            array (
                'familly_id' => 2,
                'id' => 18,
                'name' => 'Crédits - exploitation',
            ),
            18 => 
            array (
                'familly_id' => 2,
                'id' => 19,
                'name' => 'crédits - dispositif',
            ),
            19 => 
            array (
                'familly_id' => 2,
                'id' => 20,
                'name' => 'Recouvrement',
            ),
            20 => 
            array (
                'familly_id' => 3,
                'id' => 21,
                'name' => 'Crédit documentaire  ',
            ),
            21 => 
            array (
                'familly_id' => 3,
                'id' => 22,
                'name' => 'Remise documentaire ',
            ),
            22 => 
            array (
                'familly_id' => 3,
                'id' => 23,
                'name' => 'Transfert libre',
            ),
            23 => 
            array (
                'familly_id' => 3,
                'id' => 24,
                'name' => 'Déclaration - apurement',
            ),
        ));
        
        
    }
}