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
                'id' => 1,
                'name' => 'Pré domicliation et domiciliation ',
                'familly_id' => 3,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Crédit documentaire  ',
                'familly_id' => 3,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Remise documentaire ',
                'familly_id' => 3,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Transfet libre',
                'familly_id' => 3,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Déclaration - apuremen',
                'familly_id' => 3,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Arrêté de caisse et gestion des encaisses  ',
                'familly_id' => 1,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Les opérations de caisse',
                'familly_id' => 1,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Gestion E-Banking',
                'familly_id' => 1,
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Gestion comptes clientèles',
                'familly_id' => 1,
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Gestion des bons de caisse',
                'familly_id' => 1,
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Gestion de Dépôt à terme',
                'familly_id' => 1,
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Gestion des valeurs',
                'familly_id' => 1,
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'Gestion des instruments de paiements',
                'familly_id' => 1,
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'Monétique',
                'familly_id' => 1,
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'Opérations de change manuel',
                'familly_id' => 1,
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'Juridique',
                'familly_id' => 1,
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'Communication et échange en sécurité financiere',
                'familly_id' => 5,
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'Contrôle Permanent',
                'familly_id' => 5,
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'credit auto',
                'familly_id' => 2,
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'credit confort',
                'familly_id' => 2,
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'credit immobilier',
                'familly_id' => 2,
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'credit location',
                'familly_id' => 2,
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'investissement',
                'familly_id' => 2,
            ),
            23 => 
            array (
                'id' => 24,
                'name' => 'professionnel',
                'familly_id' => 2,
            ),
            24 => 
            array (
                'id' => 25,
                'name' => 'exploitation',
                'familly_id' => 2,
            ),
            25 => 
            array (
                'id' => 26,
                'name' => 'dispositif',
                'familly_id' => 2,
            ),
            26 => 
            array (
                'id' => 27,
                'name' => 'Contrôle comptable',
                'familly_id' => 4,
            ),
            27 => 
            array (
                'id' => 28,
                'name' => 'Contrôle de gestion budget',
                'familly_id' => 4,
            ),
            28 => 
            array (
                'id' => 29,
                'name' => 'Trésorerie',
                'familly_id' => 4,
            ),
            29 => 
            array (
                'id' => 30,
                'name' => 'Gestion de la ressource humaine',
                'familly_id' => 6,
            ),
            30 => 
            array (
                'id' => 31,
                'name' => 'Marketing et communication',
                'familly_id' => 6,
            ),
            31 => 
            array (
                'id' => 32,
                'name' => 'Sécurité des biens',
                'familly_id' => 6,
            ),
        ));
        
        
    }
}