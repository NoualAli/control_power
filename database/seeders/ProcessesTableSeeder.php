<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProcessesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('processes')->delete();
        
        \DB::table('processes')->insert(array (
            0 => 
            array (
                'domain_id' => 1,
                'id' => 1,
                'name' => 'Pré domicliation et domiciliation ',
            ),
            1 => 
            array (
                'domain_id' => 2,
                'id' => 2,
                'name' => 'Crédit documentaire  ',
            ),
            2 => 
            array (
                'domain_id' => 3,
                'id' => 3,
                'name' => 'Remise documentaire ',
            ),
            3 => 
            array (
                'domain_id' => 4,
                'id' => 4,
                'name' => 'Transfert libre',
            ),
            4 => 
            array (
                'domain_id' => 5,
                'id' => 5,
                'name' => 'Déclaration des dossiers ',
            ),
            5 => 
            array (
                'domain_id' => 5,
                'id' => 6,
                'name' => 'Apurement des dossiers',
            ),
            6 => 
            array (
                'domain_id' => 6,
                'id' => 7,
                'name' => 'Arrêté de caisse Dinars et devises',
            ),
            7 => 
            array (
                'domain_id' => 6,
                'id' => 8,
                'name' => 'Arrêté de la caisse DAB et GAB',
            ),
            8 => 
            array (
                'domain_id' => 6,
                'id' => 9,
                'name' => 'Envoi et réception de fonds ',
            ),
            9 => 
            array (
                'domain_id' => 6,
                'id' => 10,
                'name' => 'Journée comptable ',
            ),
            10 => 
            array (
                'domain_id' => 7,
                'id' => 11,
                'name' => 'Vérification des opérations de retrait sur chèque et livret ',
            ),
            11 => 
            array (
                'domain_id' => 7,
                'id' => 12,
                'name' => 'Vérification des opérations sur comptes devises',
            ),
            12 => 
            array (
                'domain_id' => 7,
                'id' => 13,
                'name' => 'Vérification des opérations de versement Dinars et devises ',
            ),
            13 => 
            array (
                'domain_id' => 8,
                'id' => 14,
                'name' => 'Gestion d\'un contrat E-Banking',
            ),
            14 => 
            array (
                'domain_id' => 8,
                'id' => 15,
                'name' => 'Traitement des réclamations',
            ),
            15 => 
            array (
                'domain_id' => 8,
                'id' => 16,
                'name' => 'Virements de compte à compte ',
            ),
            16 => 
            array (
                'domain_id' => 8,
                'id' => 17,
                'name' => 'Virements par EDI ',
            ),
            17 => 
            array (
                'domain_id' => 9,
                'id' => 18,
                'name' => 'Ouverture de compte ',
            ),
            18 => 
            array (
                'domain_id' => 9,
                'id' => 19,
                'name' => 'Clôture de compte à l\'initiative du client ',
            ),
            19 => 
            array (
                'domain_id' => 9,
                'id' => 20,
                'name' => 'Compte sans mouvements ',
            ),
            20 => 
            array (
                'domain_id' => 10,
                'id' => 21,
                'name' => 'Gestion des Bons de caisse',
            ),
            21 => 
            array (
                'domain_id' => 10,
                'id' => 22,
                'name' => 'Souscription du BDC Nominatif ou Anonyme ',
            ),
            22 => 
            array (
                'domain_id' => 10,
                'id' => 23,
                'name' => 'Remboursement du BDC ',
            ),
            23 => 
            array (
                'domain_id' => 11,
                'id' => 24,
                'name' => 'Souscription du DAT dinars et devises ',
            ),
            24 => 
            array (
                'domain_id' => 11,
                'id' => 25,
                'name' => 'Remboursement du DAT  ',
            ),
            25 => 
            array (
                'domain_id' => 12,
                'id' => 26,
                'name' => 'Gestion des carnets de chèques clientèle  ',
            ),
            26 => 
            array (
                'domain_id' => 12,
                'id' => 27,
                'name' => 'Gestion des carnets de chèques de banque',
            ),
            27 => 
            array (
                'domain_id' => 12,
                'id' => 28,
                'name' => 'Gestion des bons de caisse',
            ),
            28 => 
            array (
                'domain_id' => 12,
                'id' => 29,
                'name' => 'Gestion des livrets épargne ',
            ),
            29 => 
            array (
                'domain_id' => 12,
                'id' => 30,
                'name' => 'Gestion des coffres forts',
            ),
            30 => 
            array (
                'domain_id' => 13,
                'id' => 31,
                'name' => 'Chèque de banque ',
            ),
            31 => 
            array (
                'domain_id' => 13,
                'id' => 32,
                'name' => 'Prélèvement ',
            ),
            32 => 
            array (
                'domain_id' => 13,
                'id' => 33,
                'name' => 'Effet de commerce ',
            ),
            33 => 
            array (
                'domain_id' => 13,
                'id' => 34,
                'name' => 'Virements RTGS ',
            ),
            34 => 
            array (
                'domain_id' => 13,
                'id' => 35,
                'name' => 'Virements émis ',
            ),
            35 => 
            array (
                'domain_id' => 14,
                'id' => 36,
                'name' => 'Gestion des cartes bancaires et codes confidentiels',
            ),
            36 => 
            array (
                'domain_id' => 14,
                'id' => 37,
                'name' => 'Remplacement d\'une carte CIB ',
            ),
            37 => 
            array (
                'domain_id' => 14,
                'id' => 38,
                'name' => 'Annulation d\'une carte CIB ',
            ),
            38 => 
            array (
                'domain_id' => 14,
                'id' => 39,
                'name' => 'Réédition du code confidentiel ',
            ),
            39 => 
            array (
                'domain_id' => 14,
                'id' => 40,
                'name' => 'Modification du plafond de retrait/paiement d\'une carte ',
            ),
            40 => 
            array (
                'domain_id' => 14,
                'id' => 41,
                'name' => 'Mise en exception d\'une carte CIB ',
            ),
            41 => 
            array (
                'domain_id' => 14,
                'id' => 42,
                'name' => 'Gestion des TPE ',
            ),
            42 => 
            array (
                'domain_id' => 14,
                'id' => 43,
                'name' => 'Traitement et règlement des litiges monétiques porteurs de cartes',
            ),
            43 => 
            array (
                'domain_id' => 14,
                'id' => 44,
                'name' => 'E-Paiement  ',
            ),
            44 => 
            array (
                'domain_id' => 14,
                'id' => 45,
                'name' => 'Mobil GAB ',
            ),
            45 => 
            array (
                'domain_id' => 15,
                'id' => 46,
                'name' => 'Traitement des allocations touristiques',
            ),
            46 => 
            array (
                'domain_id' => 15,
                'id' => 47,
                'name' => 'Traitement des frais de mission à l\'étranger',
            ),
            47 => 
            array (
                'domain_id' => 15,
                'id' => 48,
                'name' => 'Traitement des frais de scolarités courte durée',
            ),
            48 => 
            array (
                'domain_id' => 15,
                'id' => 49,
                'name' => 'Traitement des frais de soins à l\'étranger ',
            ),
            49 => 
            array (
                'domain_id' => 15,
                'id' => 50,
                'name' => 'Cession de devises par le client ',
            ),
            50 => 
            array (
                'domain_id' => 16,
                'id' => 51,
            'name' => 'Avis à tiers détenteurs (ATD)/ Opposition des organismes sociaux ',
            ),
            51 => 
            array (
                'domain_id' => 16,
                'id' => 52,
            'name' => 'Saisies arrêts (Emises, reçues)',
            ),
            52 => 
            array (
                'domain_id' => 16,
                'id' => 53,
                'name' => 'Opposition sur chèque, chèque de banque, livret, BDC',
            ),
            53 => 
            array (
                'domain_id' => 16,
                'id' => 54,
                'name' => 'Incidents de paiements',
            ),
            54 => 
            array (
                'domain_id' => 16,
                'id' => 55,
                'name' => 'Succession ',
            ),
            55 => 
            array (
                'domain_id' => 17,
                'id' => 56,
                'name' => 'FATCA ',
            ),
            56 => 
            array (
                'domain_id' => 18,
                'id' => 57,
                'name' => 'LAB- FT ',
            ),
            57 => 
            array (
                'domain_id' => 19,
                'id' => 58,
                'name' => 'Montage du dossier de crédit ',
            ),
            58 => 
            array (
                'domain_id' => 19,
                'id' => 59,
                'name' => 'Etude et sanction du dossier de crédit',
            ),
            59 => 
            array (
                'domain_id' => 19,
                'id' => 60,
                'name' => 'Recueil des garanties à priori',
            ),
            60 => 
            array (
                'domain_id' => 19,
                'id' => 61,
                'name' => 'Déblocage de fonds ',
            ),
            61 => 
            array (
                'domain_id' => 19,
                'id' => 62,
                'name' => 'Recueil et suivi des garanties à posteriori',
            ),
            62 => 
            array (
                'domain_id' => 19,
                'id' => 63,
                'name' => 'Suivi des engagements',
            ),
            63 => 
            array (
                'domain_id' => 20,
                'id' => 64,
                'name' => 'Montage du dossier de crédit ',
            ),
            64 => 
            array (
                'domain_id' => 20,
                'id' => 65,
                'name' => 'Etude et sanction du dossier de crédit',
            ),
            65 => 
            array (
                'domain_id' => 20,
                'id' => 66,
                'name' => 'Recueil des garanties à priori',
            ),
            66 => 
            array (
                'domain_id' => 20,
                'id' => 67,
                'name' => 'Déblocage de fonds ',
            ),
            67 => 
            array (
                'domain_id' => 20,
                'id' => 68,
                'name' => 'Suivi des engagements ',
            ),
            68 => 
            array (
                'domain_id' => 21,
                'id' => 69,
                'name' => 'Montage du dossier de crédit ',
            ),
            69 => 
            array (
                'domain_id' => 21,
                'id' => 70,
                'name' => 'Etude et sanction du dossier de crédit',
            ),
            70 => 
            array (
                'domain_id' => 21,
                'id' => 71,
                'name' => 'Recueil des garanties à priori',
            ),
            71 => 
            array (
                'domain_id' => 21,
                'id' => 72,
                'name' => 'Déblocage de fonds ',
            ),
            72 => 
            array (
                'domain_id' => 21,
                'id' => 73,
                'name' => 'Receuil et Suivi des garanties à postériori ',
            ),
            73 => 
            array (
                'domain_id' => 21,
                'id' => 74,
                'name' => 'Suivi des engagements',
            ),
            74 => 
            array (
                'domain_id' => 22,
                'id' => 75,
                'name' => 'Montage du dossier de crédit ',
            ),
            75 => 
            array (
                'domain_id' => 22,
                'id' => 76,
                'name' => 'Etude et sanction du dossier de crédit',
            ),
            76 => 
            array (
                'domain_id' => 22,
                'id' => 77,
                'name' => 'Recueil des garanties à priori',
            ),
            77 => 
            array (
                'domain_id' => 22,
                'id' => 78,
                'name' => 'Recueil et suivi des garanties à posteriori',
            ),
            78 => 
            array (
                'domain_id' => 22,
                'id' => 79,
                'name' => 'Suivi des engagements',
            ),
            79 => 
            array (
                'domain_id' => 23,
                'id' => 80,
                'name' => 'Montage du dossier de crédit ',
            ),
            80 => 
            array (
                'domain_id' => 23,
                'id' => 81,
                'name' => 'Etude et sanction du dossier de crédit',
            ),
            81 => 
            array (
                'domain_id' => 23,
                'id' => 82,
                'name' => 'Recueil des garanties à priori',
            ),
            82 => 
            array (
                'domain_id' => 23,
                'id' => 83,
                'name' => 'Déblocage de fonds ',
            ),
            83 => 
            array (
                'domain_id' => 23,
                'id' => 84,
                'name' => 'Recueil des garanties à postériori',
            ),
            84 => 
            array (
                'domain_id' => 23,
                'id' => 85,
                'name' => 'Suivi des engagements ',
            ),
            85 => 
            array (
                'domain_id' => 24,
                'id' => 86,
                'name' => 'Montage du dossier de crédit ',
            ),
            86 => 
            array (
                'domain_id' => 24,
                'id' => 87,
                'name' => 'Etude et sanction du dossier de crédit',
            ),
            87 => 
            array (
                'domain_id' => 24,
                'id' => 88,
                'name' => 'Recueil des garanties à priori',
            ),
            88 => 
            array (
                'domain_id' => 24,
                'id' => 89,
                'name' => 'Déblocage de fonds ',
            ),
            89 => 
            array (
                'domain_id' => 24,
                'id' => 90,
                'name' => 'Recueil et suivi des garanties à postériori',
            ),
            90 => 
            array (
                'domain_id' => 24,
                'id' => 91,
                'name' => 'Suivi des engagements',
            ),
            91 => 
            array (
                'domain_id' => 25,
                'id' => 92,
                'name' => 'Montage du dossier de crédit ',
            ),
            92 => 
            array (
                'domain_id' => 25,
                'id' => 93,
                'name' => 'Etude et sanction du dossier de crédit',
            ),
            93 => 
            array (
                'domain_id' => 25,
                'id' => 94,
                'name' => 'Recueil des garanties à priori ',
            ),
            94 => 
            array (
                'domain_id' => 25,
                'id' => 95,
                'name' => 'Déblocage de fonds ',
            ),
            95 => 
            array (
                'domain_id' => 25,
                'id' => 96,
                'name' => 'Suivi des engagements',
            ),
            96 => 
            array (
                'domain_id' => 26,
                'id' => 97,
                'name' => 'Montage du dossier de crédit ',
            ),
            97 => 
            array (
                'domain_id' => 26,
                'id' => 98,
                'name' => 'Etude et sanction du dossier de crédit',
            ),
            98 => 
            array (
                'domain_id' => 26,
                'id' => 99,
                'name' => 'Recueil des garanties à priori  ',
            ),
            99 => 
            array (
                'domain_id' => 26,
                'id' => 100,
                'name' => 'Déblocage de fonds ',
            ),
            100 => 
            array (
                'domain_id' => 26,
                'id' => 101,
                'name' => 'Recueil et suivi des garanties à postériori   ',
            ),
            101 => 
            array (
                'domain_id' => 26,
                'id' => 102,
                'name' => 'Suivi des engagements',
            ),
            102 => 
            array (
                'domain_id' => 27,
                'id' => 103,
                'name' => 'Suivi des comptes financiers',
            ),
            103 => 
            array (
                'domain_id' => 27,
                'id' => 104,
                'name' => 'Suivi des comptes internes',
            ),
            104 => 
            array (
                'domain_id' => 27,
                'id' => 105,
                'name' => 'Suivi des liaison siège',
            ),
            105 => 
            array (
                'domain_id' => 28,
                'id' => 106,
                'name' => 'Suivi du budget ',
            ),
            106 => 
            array (
                'domain_id' => 29,
                'id' => 107,
                'name' => 'Compte CCP ',
            ),
            107 => 
            array (
                'domain_id' => 29,
                'id' => 108,
                'name' => 'Compte Trésor public ',
            ),
            108 => 
            array (
                'domain_id' => 29,
                'id' => 109,
                'name' => 'Compte Banque d\'algérie ',
            ),
            109 => 
            array (
                'domain_id' => 30,
                'id' => 110,
                'name' => 'Gestion des habilitations ',
            ),
            110 => 
            array (
                'domain_id' => 30,
                'id' => 111,
                'name' => 'Avance sur appointement/salaire ',
            ),
            111 => 
            array (
                'domain_id' => 30,
                'id' => 112,
                'name' => 'Gestion des congés annuels ',
            ),
            112 => 
            array (
                'domain_id' => 30,
                'id' => 113,
                'name' => 'Gestion des absences longue durée ',
            ),
            113 => 
            array (
                'domain_id' => 30,
                'id' => 114,
                'name' => 'Tenue des livres légaux ',
            ),
            114 => 
            array (
                'domain_id' => 31,
                'id' => 115,
                'name' => 'Commercialisation des produits d\'assurance',
            ),
            115 => 
            array (
                'domain_id' => 32,
                'id' => 116,
                'name' => 'Assurance des fonds',
            ),
            116 => 
            array (
                'domain_id' => 32,
                'id' => 117,
                'name' => 'Sécurité et protection des personnes et des biens',
            ),
        ));
        
        
    }
}