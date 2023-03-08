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
                'familly_id' => 3,
                'id' => 1,
                'name' => 'Pré domicliation et domiciliation ',
            ),
            1 => 
            array (
                'familly_id' => 3,
                'id' => 2,
                'name' => 'Crédit documentaire  ',
            ),
            2 => 
            array (
                'familly_id' => 3,
                'id' => 3,
                'name' => 'Remise documentaire ',
            ),
            3 => 
            array (
                'familly_id' => 3,
                'id' => 4,
                'name' => 'Transfet libre',
            ),
            4 => 
            array (
                'familly_id' => 3,
                'id' => 5,
                'name' => 'Déclaration - apuremen',
            ),
            5 => 
            array (
                'familly_id' => 1,
                'id' => 6,
                'name' => 'Arrêté de caisse et gestion des encaisses  ',
            ),
            6 => 
            array (
                'familly_id' => 1,
                'id' => 7,
                'name' => 'Les opérations de caisse',
            ),
            7 => 
            array (
                'familly_id' => 1,
                'id' => 8,
                'name' => 'Gestion E-Banking',
            ),
            8 => 
            array (
                'familly_id' => 1,
                'id' => 9,
                'name' => 'Gestion comptes clientèles',
            ),
            9 => 
            array (
                'familly_id' => 1,
                'id' => 10,
                'name' => 'Gestion des bons de caisse',
            ),
            10 => 
            array (
                'familly_id' => 1,
                'id' => 11,
                'name' => 'Gestion de Dépôt à terme',
            ),
            11 => 
            array (
                'familly_id' => 1,
                'id' => 12,
                'name' => 'Gestion des valeurs',
            ),
            12 => 
            array (
                'familly_id' => 1,
                'id' => 13,
                'name' => 'Gestion des instruments de paiements',
            ),
            13 => 
            array (
                'familly_id' => 1,
                'id' => 14,
                'name' => 'Monétique',
            ),
            14 => 
            array (
                'familly_id' => 1,
                'id' => 15,
                'name' => 'Opérations de change manuel',
            ),
            15 => 
            array (
                'familly_id' => 1,
                'id' => 16,
                'name' => 'Juridique',
            ),
            16 => 
            array (
                'familly_id' => 5,
                'id' => 17,
                'name' => 'Communication et échange en sécurité financiere',
            ),
            17 => 
            array (
                'familly_id' => 5,
                'id' => 18,
                'name' => 'Contrôle Permanent',
            ),
            18 => 
            array (
                'familly_id' => 2,
                'id' => 19,
                'name' => 'credit auto',
            ),
            19 => 
            array (
                'familly_id' => 2,
                'id' => 20,
                'name' => 'credit confort',
            ),
            20 => 
            array (
                'familly_id' => 2,
                'id' => 21,
                'name' => 'credit immobilier',
            ),
            21 => 
            array (
                'familly_id' => 2,
                'id' => 22,
                'name' => 'credit location',
            ),
            22 => 
            array (
                'familly_id' => 2,
                'id' => 23,
                'name' => 'investissement',
            ),
            23 => 
            array (
                'familly_id' => 2,
                'id' => 24,
                'name' => 'professionnel',
            ),
            24 => 
            array (
                'familly_id' => 2,
                'id' => 25,
                'name' => 'exploitation',
            ),
            25 => 
            array (
                'familly_id' => 2,
                'id' => 26,
                'name' => 'dispositif',
            ),
            26 => 
            array (
                'familly_id' => 4,
                'id' => 27,
                'name' => 'Contrôle comptable',
            ),
            27 => 
            array (
                'familly_id' => 4,
                'id' => 28,
                'name' => 'Contrôle de gestion budget',
            ),
            28 => 
            array (
                'familly_id' => 4,
                'id' => 29,
                'name' => 'Trésorerie',
            ),
            29 => 
            array (
                'familly_id' => 6,
                'id' => 30,
                'name' => 'Gestion de la ressource humaine',
            ),
            30 => 
            array (
                'familly_id' => 6,
                'id' => 31,
                'name' => 'Marketing et communication',
            ),
            31 => 
            array (
                'familly_id' => 6,
                'id' => 32,
                'name' => 'Sécurité des biens',
            ),
        ));
        
        
    }
}