<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('permissions')->delete();
        
        \DB::table('permissions')->insert(array (
            0 => 
            array (
                'code' => 'edit_role',
                'id' => 1,
                'module_id' => 2,
                'name' => 'Modifier les rôles utilisateur',
            ),
            1 => 
            array (
                'code' => 'create_role',
                'id' => 2,
                'module_id' => 2,
                'name' => 'Créer les rôles utilisateur',
            ),
            2 => 
            array (
                'code' => 'delete_role',
                'id' => 3,
                'module_id' => 2,
                'name' => 'Supprimer les rôles utilisateur',
            ),
            3 => 
            array (
                'code' => 'view_role',
                'id' => 4,
                'module_id' => 2,
                'name' => 'Voir les rôles utilisateur',
            ),
            4 => 
            array (
                'code' => 'create_user',
                'id' => 5,
                'module_id' => 2,
                'name' => 'Créer les utilisateurs',
            ),
            5 => 
            array (
                'code' => 'delete_user',
                'id' => 6,
                'module_id' => 2,
                'name' => 'Supprimer les utilisateurs',
            ),
            6 => 
            array (
                'code' => 'view_user',
                'id' => 8,
                'module_id' => 2,
                'name' => 'Voir les utilisateurs',
            ),
            7 => 
            array (
                'code' => 'manage_modules',
                'id' => 11,
                'module_id' => 2,
                'name' => 'Gérer les modules',
            ),
            8 => 
            array (
                'code' => 'view_modules',
                'id' => 12,
                'module_id' => 2,
                'name' => 'Voir les modules',
            ),
            9 => 
            array (
                'code' => 'edit_user',
                'id' => 13,
                'module_id' => 2,
                'name' => 'Modifier les utilisateurs',
            ),
            10 => 
            array (
                'code' => 'create_dre',
                'id' => 14,
                'module_id' => 1,
                'name' => 'Créer les DRE',
            ),
            11 => 
            array (
                'code' => 'edit_dre',
                'id' => 15,
                'module_id' => 1,
                'name' => 'Modifier les DRE',
            ),
            12 => 
            array (
                'code' => 'delete_dre',
                'id' => 16,
                'module_id' => 1,
                'name' => 'Supprimer les DRE',
            ),
            13 => 
            array (
                'code' => 'view_dre',
                'id' => 17,
                'module_id' => 1,
                'name' => 'Voir les DRE',
            ),
            14 => 
            array (
                'code' => 'create_agency',
                'id' => 18,
                'module_id' => 1,
                'name' => 'Créer les agences',
            ),
            15 => 
            array (
                'code' => 'view_agency',
                'id' => 19,
                'module_id' => 1,
                'name' => 'Voir les agences',
            ),
            16 => 
            array (
                'code' => 'edit_agency',
                'id' => 20,
                'module_id' => 1,
                'name' => 'Modifier les agence',
            ),
            17 => 
            array (
                'code' => 'delete_agency',
                'id' => 21,
                'module_id' => 1,
                'name' => 'Supprimer les agences',
            ),
            18 => 
            array (
                'code' => 'create_familly',
                'id' => 22,
                'module_id' => 5,
                'name' => 'Créer les familles',
            ),
            19 => 
            array (
                'code' => 'view_familly',
                'id' => 23,
                'module_id' => 5,
                'name' => 'Voir les familles',
            ),
            20 => 
            array (
                'code' => 'edit_familly',
                'id' => 24,
                'module_id' => 5,
                'name' => 'Modifier les familles',
            ),
            21 => 
            array (
                'code' => 'delete_familly',
                'id' => 25,
                'module_id' => 5,
                'name' => 'Supprimer les famille',
            ),
            22 => 
            array (
                'code' => 'create_domain',
                'id' => 26,
                'module_id' => 5,
                'name' => 'Créer les domaines',
            ),
            23 => 
            array (
                'code' => 'edit_domain',
                'id' => 27,
                'module_id' => 5,
                'name' => 'Modifier les domaines',
            ),
            24 => 
            array (
                'code' => 'view_domain',
                'id' => 28,
                'module_id' => 5,
                'name' => 'Voir les domaines',
            ),
            25 => 
            array (
                'code' => 'delete_domain',
                'id' => 29,
                'module_id' => 5,
                'name' => 'Supprimer les domaines',
            ),
            26 => 
            array (
                'code' => 'create_process',
                'id' => 30,
                'module_id' => 5,
                'name' => 'Créer les processus',
            ),
            27 => 
            array (
                'code' => 'edit_process',
                'id' => 31,
                'module_id' => 5,
                'name' => 'Modifier les processus',
            ),
            28 => 
            array (
                'code' => 'view_process',
                'id' => 32,
                'module_id' => 5,
                'name' => 'Voir les processus',
            ),
            29 => 
            array (
                'code' => 'delete_process',
                'id' => 33,
                'module_id' => 5,
                'name' => 'Supprimer les processus',
            ),
            30 => 
            array (
                'code' => 'create_control_point',
                'id' => 34,
                'module_id' => 5,
                'name' => 'Créer les points de contrôle',
            ),
            31 => 
            array (
                'code' => 'edit_control_point',
                'id' => 35,
                'module_id' => 5,
                'name' => 'Modifier les points de contrôle',
            ),
            32 => 
            array (
                'code' => 'view_control_point',
                'id' => 36,
                'module_id' => 5,
                'name' => 'Voir les points de contrôle',
            ),
            33 => 
            array (
                'code' => 'delete_control_point',
                'id' => 37,
                'module_id' => 5,
                'name' => 'Supprimer les points de contrôle',
            ),
            34 => 
            array (
                'code' => 'create_control_campaign',
                'id' => 38,
                'module_id' => 4,
                'name' => 'Créer les campagnes de contrôle',
            ),
            35 => 
            array (
                'code' => 'edit_control_campaign',
                'id' => 39,
                'module_id' => 4,
                'name' => 'Modifier les campagnes de contrôle',
            ),
            36 => 
            array (
                'code' => 'view_control_campaign',
                'id' => 40,
                'module_id' => 4,
                'name' => 'Voir les campagnes de contrôle',
            ),
            37 => 
            array (
                'code' => 'delete_control_campaign',
                'id' => 41,
                'module_id' => 4,
                'name' => 'Supprimer les campagnes de contrôle',
            ),
            38 => 
            array (
                'code' => 'create_mission',
                'id' => 42,
                'module_id' => 3,
                'name' => 'Créer les missions',
            ),
            39 => 
            array (
                'code' => 'edit_mission',
                'id' => 43,
                'module_id' => 3,
                'name' => 'Modifier les missions',
            ),
            40 => 
            array (
                'code' => 'delete_mission',
                'id' => 44,
                'module_id' => 3,
                'name' => 'Supprimer les missions',
            ),
            41 => 
            array (
                'code' => 'view_mission',
                'id' => 45,
                'module_id' => 3,
                'name' => 'Voir les missions',
            ),
            42 => 
            array (
                'code' => 'control_agency',
                'id' => 46,
                'module_id' => 6,
                'name' => 'Contrôler les agences',
            ),
            43 => 
            array (
                'code' => 'create_ci_report',
                'id' => 47,
                'module_id' => 6,
                'name' => 'Créer le compte-rendu de la mission',
            ),
            44 => 
            array (
                'code' => 'create_cdc_report',
                'id' => 48,
                'module_id' => 6,
                'name' => 'Créer la conclusion de la mission',
            ),
            45 => 
            array (
                'code' => 'view_mission_detail',
                'id' => 49,
                'module_id' => 3,
                'name' => 'Voir les détails de la mission',
            ),
            46 => 
            array (
                'code' => 'validate_cdc_report',
                'id' => 50,
                'module_id' => 6,
                'name' => 'Validation de la conclusion de la mission',
            ),
            47 => 
            array (
                'code' => 'validate_ci_report',
                'id' => 51,
                'module_id' => 6,
                'name' => 'Validation du compte-rendu de la mission',
            ),
            48 => 
            array (
                'code' => 'view_major_fact',
                'id' => 52,
                'module_id' => 3,
                'name' => 'Voir les faits majeur',
            ),
            49 => 
            array (
                'code' => 'view_opinion',
                'id' => 53,
                'module_id' => 6,
                'name' => 'Voir le compte-rendu de la mission',
            ),
            50 => 
            array (
                'code' => 'view_dre_report',
                'id' => 54,
                'module_id' => 6,
                'name' => 'Voir la conclusion de la mission',
            ),
            51 => 
            array (
                'code' => 'process_mission',
                'id' => 55,
                'module_id' => 6,
                'name' => 'Executer la mission',
            ),
            52 => 
            array (
                'code' => 'assign_mission_processing',
                'id' => 56,
                'module_id' => 3,
                'name' => 'Déléguer le traitement de la mission',
            ),
            53 => 
            array (
                'code' => 'fetch_processes_list',
                'id' => 57,
                'module_id' => 3,
                'name' => 'Voir la liste des processus',
            ),
            54 => 
            array (
                'code' => 'dispatch_major_fact',
                'id' => 58,
                'module_id' => 3,
                'name' => 'Dispatcher le fait majeur',
            ),
            55 => 
            array (
                'code' => 'view_page_control_campaigns',
                'id' => 59,
                'module_id' => 4,
                'name' => 'Voir la page campagne de contrôle',
            ),
            56 => 
            array (
                'code' => 'view_page_users',
                'id' => 60,
                'module_id' => 2,
                'name' => 'Voir la page utilisateurs',
            ),
            57 => 
            array (
                'code' => 'view_page_roles',
                'id' => 61,
                'module_id' => 2,
                'name' => 'Voir la page rôles',
            ),
            58 => 
            array (
                'code' => 'view_page_modules',
                'id' => 62,
                'module_id' => 2,
                'name' => 'Voir la page modules',
            ),
            59 => 
            array (
                'code' => 'view_page_dres',
                'id' => 63,
                'module_id' => 1,
                'name' => 'Voir la page DRE',
            ),
            60 => 
            array (
                'code' => 'view_page_agencies',
                'id' => 64,
                'module_id' => 1,
                'name' => 'Voir la page agences',
            ),
            61 => 
            array (
                'code' => 'view_page_families',
                'id' => 65,
                'module_id' => 1,
                'name' => 'Voir la page familles',
            ),
            62 => 
            array (
                'code' => 'view_page_domains',
                'id' => 66,
                'module_id' => 1,
                'name' => 'Voir la page domaines',
            ),
            63 => 
            array (
                'code' => 'view_page_processes',
                'id' => 67,
                'module_id' => 5,
                'name' => 'Voir la page processus',
            ),
            64 => 
            array (
                'code' => 'view_page_control_points',
                'id' => 68,
                'module_id' => 5,
                'name' => 'Voir la page points de contrôle',
            ),
            65 => 
            array (
                'code' => 'view_page_missions',
                'id' => 69,
                'module_id' => 3,
                'name' => 'Voir la page missions',
            ),
            66 => 
            array (
                'code' => 'view_page_major_facts',
                'id' => 70,
                'module_id' => 3,
                'name' => 'Voir la page faits majeur',
            ),
            67 => 
            array (
                'code' => 'view_page_mission_details',
                'id' => 71,
                'module_id' => 3,
                'name' => 'Voir la page détails de missions',
            ),
            68 => 
            array (
                'code' => 'make_first_validation',
                'id' => 72,
                'module_id' => 6,
                'name' => '1ère validation',
            ),
            69 => 
            array (
                'code' => 'make_second_validation',
                'id' => 73,
                'module_id' => 6,
                'name' => '2ème validation',
            ),
            70 => 
            array (
                'code' => 'regularize_mission_detail',
                'id' => 74,
                'module_id' => 6,
                'name' => 'Régularisation des anomalies',
            ),
            71 => 
            array (
                'code' => 'validate_control_campaign',
                'id' => 75,
                'module_id' => 4,
                'name' => 'Valider la campagne de contrôle',
            ),
            72 => 
            array (
                'code' => 'create_category',
                'id' => 76,
                'module_id' => 1,
                'name' => 'Créer catégorie',
            ),
            73 => 
            array (
                'code' => 'edit_category',
                'id' => 77,
                'module_id' => 1,
                'name' => 'Modifier catégorie',
            ),
            74 => 
            array (
                'code' => 'delete_category',
                'id' => 78,
                'module_id' => 1,
                'name' => 'Supprimer catégorie',
            ),
            75 => 
            array (
                'code' => 'view_category',
                'id' => 79,
                'module_id' => 1,
                'name' => 'Voir les catégories',
            ),
            76 => 
            array (
                'code' => 'view_page_categories',
                'id' => 80,
                'module_id' => 1,
                'name' => 'Voir la page catégories',
            ),
        ));
        
        
    }
}