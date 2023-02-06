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
                'content' => '<p>L\'objectif de cette mission était d\'évaluer la conformité des activités de l\'agence avec les politiques et les procédures de la <strong>BNA</strong>. Les contrôleurs ont également vérifié la conformité avec les lois et réglementations bancaires en vigueur.</p><p>Lors de la mission, les contrôleurs ont examiné les dossiers financiers et les opérations de l\'agence, y compris les activités de prêt et de dépôt. Ils ont également vérifié les systèmes de contrôle interne de l\'agence pour s\'assurer de leur efficacité et de leur adéquation.</p><p><br></p><p>Les résultats de la mission ont montré que l\'Agence <strong>DAR EL BEIDA</strong> a largement respecté les politiques et les procédures de la BNA. Cependant, des améliorations ont été identifiées dans certains domaines, notamment en ce qui concerne l\'actualisation régulière des informations clients et la mise en œuvre de mesures de contrôle supplémentaires pour renforcer la sécurité des opérations financières.</p><p><strong>Le Chef de Département</strong> des contrôleurs a fourni des recommandations pour corriger les insuffisances identifiées et a exhorté l\'Agence <strong>DAR EL BEIDA</strong> à poursuivre ses efforts pour maintenir une conformité élevée avec les politiques et les procédures de la BNA.</p><p>En conclusion, la mission de contrôle de l\'Agence <strong>612 - Agence DAR EL BEIDA a été une réussite </strong>et a permis de renforcer la conformité de l\'agence avec <strong>les politiques et les procédures de la BNA</strong>. Les améliorations recommandées permettront également de <strong>renforcer la sécurité des opérations financières et d\'améliorer les services</strong> offerts aux clients.</p>',
                'created_at' => '2023-02-04 22:01:44',
                'created_by_id' => 10,
                'deleted_at' => NULL,
                'id' => '4c8504c5-56ba-49c9-8686-0dad9a2bc371',
                'mission_id' => '25222f9d-cd36-4b05-8877-b4d2b1e0aa6b',
                'type' => 'Rapport',
                'updated_at' => '2023-02-05 11:38:34',
                'validated_at' => '2023-02-05 11:38:34',
            ),
            1 => 
            array (
                'content' => '<p>L\'agence bancaire de la&nbsp;<strong>BNA</strong>&nbsp;a été contrôlée le&nbsp;<strong>1er février 2023</strong>.</p><p>Les opérations de contrôle ont porté sur les activités de la banque et les processus de conformité.</p><p>Les résultats ont montré que l\'agence est en bonne forme, avec des processus bien établis et des employés compétents.</p><p>Toutefois, des améliorations ont été recommandées pour les processus de gestion des risques et de suivi de la conformité.</p><p>Le rapport final sera soumis dans les prochaines semaines pour examen.</p>',
                'created_at' => '2023-02-04 19:44:12',
                'created_by_id' => 14,
                'deleted_at' => NULL,
                'id' => 'a48fba7a-01e3-4aaa-9378-d7b160fc13a7',
                'mission_id' => '25222f9d-cd36-4b05-8877-b4d2b1e0aa6b',
                'type' => 'Avis contrôleur',
                'updated_at' => '2023-02-05 14:01:54',
                'validated_at' => '2023-02-05 14:01:54',
            ),
        ));
        
        
    }
}