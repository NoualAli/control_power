<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MissionReportsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('mission_reports')->delete();
        
        \DB::table('mission_reports')->insert(array (
            0 => 
            array (
                'id' => 'a48fba7a-01e3-4aaa-9378-d7b160fc13a7',
                'type' => 'Avis contrôleur',
                'content' => '<p>L\'agence bancaire de la&nbsp;<strong>BNA</strong>&nbsp;a été contrôlée le&nbsp;<strong>1er février 2023</strong>.</p><p>Les opérations de contrôle ont porté sur les activités de la banque et les processus de conformité.</p><p>Les résultats ont montré que l\'agence est en bonne forme, avec des processus bien établis et des employés compétents.</p><p>Toutefois, des améliorations ont été recommandées pour les processus de gestion des risques et de suivi de la conformité.</p><p>Le rapport final sera soumis dans les prochaines semaines pour examen.</p>',
                'mission_id' => '25222f9d-cd36-4b05-8877-b4d2b1e0aa6b',
                'created_by_id' => 14,
                'validated_at' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2023-02-04 19:44:12',
                'updated_at' => '2023-02-04 20:58:41',
            ),
        ));
        
        
    }
}