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
                'id' => '61b9292a-a2e5-4081-ad7b-3eafa4b65610',
                'type' => 'Rapport',
            'content' => '<p>L\'objectif de cette mission était d\'évaluer la conformité des activités de l\'agence avec les politiques et les procédures de la <strong>BNA</strong>. Les contrôleurs ont également vérifié la conformité avec les lois et réglementations bancaires en vigueur.</p><p>Lors de la mission, les contrôleurs ont examiné les dossiers financiers et les opérations de l\'agence, y compris les activités de prêt et de dépôt. Ils ont également vérifié les systèmes de contrôle interne de l\'agence pour s\'assurer de leur efficacité et de leur adéquation.</p><p>Les résultats de la mission ont montré que l\'Agence <strong>DAR EL BEIDA</strong> a largement respecté les politiques et les procédures de la BNA. Cependant, des améliorations ont été identifiées dans certains domaines, notamment en ce qui concerne l\'actualisation régulière des informations clients et la mise en œuvre de mesures de contrôle supplémentaires pour renforcer la sécurité des opérations financières.</p><p>Le <strong>Chef de Département</strong> des contrôleurs a fourni des recommandations pour corriger les insuffisances identifiées et a exhorté l\'Agence <strong>DAR EL BEIDA</strong> à poursuivre ses efforts pour maintenir une conformité élevée avec les politiques et les procédures de la BNA.</p><p>En conclusion, la mission de contrôle de l\'Agence <strong>612 - Agence DAR EL BEIDA a été </strong><strong style="color: rgb(0, 138, 0);">une réussite</strong> et a permis de renforcer la conformité de l\'agence avec <strong>les politiques et les procédures de la BNA</strong>. Les améliorations recommandées permettront également de <strong>renforcer la sécurité des opérations financières et d\'améliorer les services</strong> offerts aux clients.</p>',
                'mission_id' => '25222f9d-cd36-4b05-8877-b4d2b1e0aa6b',
                'created_by_id' => 5,
                'validated_at' => '2023-02-18 21:32:22',
                'deleted_at' => NULL,
                'created_at' => '2023-02-16 14:16:20',
                'updated_at' => '2023-02-18 21:32:22',
            ),
            1 => 
            array (
                'id' => 'f8fc8b23-b416-4bbc-8469-2f9bfad20192',
                'type' => 'Avis contrôleur',
                'content' => '<p>L\'agence bancaire de la <strong>BNA</strong> a été contrôlée le <strong>1er février 2023</strong>.</p><p>Les opérations de contrôle ont porté sur les activités de la banque et les processus de conformité.</p><p>Les résultats ont montré que l\'agence est en bonne forme, avec des processus bien établis et des employés compétents.</p><p>Toutefois, des améliorations ont été recommandées pour les processus de gestion des risques et de suivi de la conformité.</p><p>Le rapport final sera soumis dans les prochaines semaines pour examen.</p>',
                'mission_id' => '25222f9d-cd36-4b05-8877-b4d2b1e0aa6b',
                'created_by_id' => 9,
                'validated_at' => '2023-02-18 21:31:46',
                'deleted_at' => NULL,
                'created_at' => '2023-02-16 11:44:40',
                'updated_at' => '2023-02-18 21:31:46',
            ),
        ));
        
        
    }
}