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
                'name' => 'Gestion d\'un contrat E-Banking',
            ),
            1 => 
            array (
                'domain_id' => 1,
                'id' => 2,
                'name' => 'Traitement des réclamations',
            ),
            2 => 
            array (
                'domain_id' => 1,
                'id' => 3,
                'name' => 'Virements de compte à compte',
            ),
            3 => 
            array (
                'domain_id' => 1,
                'id' => 4,
                'name' => 'Virements par EDI',
            ),
            4 => 
            array (
                'domain_id' => 2,
                'id' => 5,
                'name' => 'Traitement des allocations touristiques',
            ),
            5 => 
            array (
                'domain_id' => 2,
                'id' => 6,
                'name' => 'Traitement des frais de mission à l\'étranger',
            ),
            6 => 
            array (
                'domain_id' => 2,
                'id' => 7,
                'name' => 'Traitement des frais de scolarités courte durée',
            ),
            7 => 
            array (
                'domain_id' => 2,
                'id' => 8,
                'name' => 'Traitement des frais de soins à l\'étranger',
            ),
            8 => 
            array (
                'domain_id' => 2,
                'id' => 9,
                'name' => 'Cession de devises par le client',
            ),
            9 => 
            array (
                'domain_id' => 3,
                'id' => 10,
                'name' => 'Ouverture de compte',
            ),
            10 => 
            array (
                'domain_id' => 3,
                'id' => 11,
            'name' => 'Clôture de compte (à l\'initiative du client)',
            ),
            11 => 
            array (
                'domain_id' => 3,
                'id' => 12,
                'name' => 'Compte sans mouvements',
            ),
            12 => 
            array (
                'domain_id' => 5,
                'id' => 21,
                'name' => 'Gestion des cartes bancaires et codes confidentiels',
            ),
            13 => 
            array (
                'domain_id' => 5,
                'id' => 22,
                'name' => 'Remplacement d\'une carte CIB ',
            ),
            14 => 
            array (
                'domain_id' => 5,
                'id' => 23,
                'name' => 'Annulation d\'une carte CIB ',
            ),
            15 => 
            array (
                'domain_id' => 5,
                'id' => 24,
                'name' => 'Réédition du code confidentiel ',
            ),
            16 => 
            array (
                'domain_id' => 5,
                'id' => 25,
                'name' => 'Modification du plafond de retrait/paiement d\'une carte ',
            ),
            17 => 
            array (
                'domain_id' => 5,
                'id' => 26,
                'name' => 'Mise en exception d\'une carte CIB ',
            ),
            18 => 
            array (
                'domain_id' => 5,
                'id' => 27,
                'name' => 'Gestion des TPE ',
            ),
            19 => 
            array (
                'domain_id' => 5,
                'id' => 28,
                'name' => 'Traitement et règlement des litiges monétiques porteurs de cartes',
            ),
            20 => 
            array (
                'domain_id' => 5,
                'id' => 29,
                'name' => 'E-Paiement  ',
            ),
            21 => 
            array (
                'domain_id' => 5,
                'id' => 30,
                'name' => 'Mobil GAB ',
            ),
            22 => 
            array (
                'domain_id' => 6,
                'id' => 31,
                'name' => 'Gestion des Bons de caisse',
            ),
            23 => 
            array (
                'domain_id' => 6,
                'id' => 32,
                'name' => 'Souscription du BDC Nominatif ou Anonyme ',
            ),
            24 => 
            array (
                'domain_id' => 6,
                'id' => 33,
                'name' => 'Remboursement du BDC ',
            ),
            25 => 
            array (
                'domain_id' => 7,
                'id' => 34,
                'name' => 'Souscription du DAT dinars et devises ',
            ),
            26 => 
            array (
                'domain_id' => 7,
                'id' => 35,
                'name' => 'Remboursement du DAT  ',
            ),
            27 => 
            array (
                'domain_id' => 8,
                'id' => 36,
                'name' => 'Gestion des carnets de chèques clientèle  ',
            ),
            28 => 
            array (
                'domain_id' => 8,
                'id' => 37,
                'name' => 'Gestion des carnets de chèques de banque',
            ),
            29 => 
            array (
                'domain_id' => 8,
                'id' => 38,
                'name' => 'Gestion des bons de caisse',
            ),
            30 => 
            array (
                'domain_id' => 8,
                'id' => 39,
                'name' => 'Gestion des livrets épargne ',
            ),
            31 => 
            array (
                'domain_id' => 8,
                'id' => 40,
                'name' => 'Gestion des coffres forts',
            ),
            32 => 
            array (
                'domain_id' => 9,
                'id' => 41,
            'name' => 'Avis à tiers détenteurs (ATD)/ Opposition des organismes sociaux ',
            ),
            33 => 
            array (
                'domain_id' => 9,
                'id' => 42,
            'name' => 'Saisies arrêts (Emises, reçues)',
            ),
            34 => 
            array (
                'domain_id' => 9,
                'id' => 43,
                'name' => 'Opposition sur chèque, chèque de banque, livret, BDC',
            ),
            35 => 
            array (
                'domain_id' => 9,
                'id' => 44,
                'name' => 'Incidents de paiements',
            ),
            36 => 
            array (
                'domain_id' => 9,
                'id' => 45,
                'name' => 'Succession ',
            ),
            37 => 
            array (
                'domain_id' => 10,
                'id' => 46,
                'name' => 'Arrêté de caisse Dinars et devises',
            ),
            38 => 
            array (
                'domain_id' => 10,
                'id' => 47,
                'name' => 'Arrêté de la caisse DAB et GAB',
            ),
            39 => 
            array (
                'domain_id' => 10,
                'id' => 48,
                'name' => 'Envoi et réception de fonds ',
            ),
            40 => 
            array (
                'domain_id' => 10,
                'id' => 49,
                'name' => 'Journée comptable ',
            ),
            41 => 
            array (
                'domain_id' => 4,
                'id' => 50,
                'name' => 'Vérification des opérations de retrait sur chèque et livret',
            ),
            42 => 
            array (
                'domain_id' => 4,
                'id' => 51,
                'name' => 'Vérification des opérations de retrait sur compte devises',
            ),
            43 => 
            array (
                'domain_id' => 4,
                'id' => 52,
                'name' => 'Vérification des opérations de versement ',
            ),
            44 => 
            array (
                'domain_id' => 11,
                'id' => 53,
                'name' => 'Chèque de banque ',
            ),
            45 => 
            array (
                'domain_id' => 11,
                'id' => 54,
                'name' => 'Prélèvement ',
            ),
            46 => 
            array (
                'domain_id' => 11,
                'id' => 55,
                'name' => 'Effet de commerce ',
            ),
            47 => 
            array (
                'domain_id' => 11,
                'id' => 56,
                'name' => 'Virements RTGS ',
            ),
            48 => 
            array (
                'domain_id' => 11,
                'id' => 57,
                'name' => 'Virements émis ',
            ),
            49 => 
            array (
                'domain_id' => 11,
                'id' => 58,
                'name' => 'Virements reçus ',
            ),
            50 => 
            array (
                'domain_id' => 11,
                'id' => 59,
                'name' => 'Chèques émis ',
            ),
            51 => 
            array (
                'domain_id' => 11,
                'id' => 60,
                'name' => 'Chèques reçus ',
            ),
            52 => 
            array (
                'domain_id' => 12,
                'id' => 62,
                'name' => 'Montage du dossier de crédit ',
            ),
            53 => 
            array (
                'domain_id' => 12,
                'id' => 63,
                'name' => 'Etude et sanction du dossier de crédit',
            ),
            54 => 
            array (
                'domain_id' => 12,
                'id' => 64,
                'name' => 'Recueil des garanties à priori',
            ),
            55 => 
            array (
                'domain_id' => 12,
                'id' => 65,
                'name' => 'Déblocage de fonds ',
            ),
            56 => 
            array (
                'domain_id' => 12,
                'id' => 66,
                'name' => 'Recueil et suivi des garanties à posteriori',
            ),
            57 => 
            array (
                'domain_id' => 12,
                'id' => 67,
                'name' => 'Suivi des engagements',
            ),
            58 => 
            array (
                'domain_id' => 12,
                'id' => 68,
                'name' => 'Décés du client détenteur d\'un crédit',
            ),
            59 => 
            array (
                'domain_id' => 13,
                'id' => 69,
                'name' => 'Montage du dossier de crédit ',
            ),
            60 => 
            array (
                'domain_id' => 13,
                'id' => 70,
                'name' => 'Etude et sanction du dossier de crédit',
            ),
            61 => 
            array (
                'domain_id' => 13,
                'id' => 71,
                'name' => 'Recueil des garanties à priori',
            ),
            62 => 
            array (
                'domain_id' => 13,
                'id' => 72,
                'name' => 'Déblocage de fonds ',
            ),
            63 => 
            array (
                'domain_id' => 13,
                'id' => 73,
                'name' => 'Suivi des engagements ',
            ),
            64 => 
            array (
                'domain_id' => 13,
                'id' => 74,
                'name' => 'Décès du client détenteur d\'un crédit',
            ),
            65 => 
            array (
                'domain_id' => 14,
                'id' => 75,
                'name' => 'Montage du dossier de crédit ',
            ),
            66 => 
            array (
                'domain_id' => 14,
                'id' => 76,
                'name' => 'Etude et sanction du dossier de crédit',
            ),
            67 => 
            array (
                'domain_id' => 14,
                'id' => 77,
                'name' => 'Recueil des garanties à priori',
            ),
            68 => 
            array (
                'domain_id' => 14,
                'id' => 78,
                'name' => 'Déblocage de fonds ',
            ),
            69 => 
            array (
                'domain_id' => 14,
                'id' => 79,
                'name' => 'Receuil et Suivi des garanties à postériori ',
            ),
            70 => 
            array (
                'domain_id' => 14,
                'id' => 80,
                'name' => 'Suivi des engagements',
            ),
            71 => 
            array (
                'domain_id' => 14,
                'id' => 81,
                'name' => 'Décès du client détenteur d\'un crédit',
            ),
            72 => 
            array (
                'domain_id' => 14,
                'id' => 82,
                'name' => 'Report d\'échéance ou rééchelonnement ',
            ),
            73 => 
            array (
                'domain_id' => 15,
                'id' => 83,
                'name' => 'Montage du dossier de crédit ',
            ),
            74 => 
            array (
                'domain_id' => 15,
                'id' => 84,
                'name' => 'Etude et sanction du dossier de crédit',
            ),
            75 => 
            array (
                'domain_id' => 15,
                'id' => 85,
                'name' => 'Recueil des garanties à priori',
            ),
            76 => 
            array (
                'domain_id' => 15,
                'id' => 86,
                'name' => 'Déblocage de fonds ',
            ),
            77 => 
            array (
                'domain_id' => 15,
                'id' => 87,
                'name' => 'Recueil et suivi des garanties à posteriori',
            ),
            78 => 
            array (
                'domain_id' => 15,
                'id' => 88,
                'name' => 'Suivi des engagements',
            ),
            79 => 
            array (
                'domain_id' => 15,
                'id' => 89,
                'name' => 'Décès du client détenteur d\'un crédit',
            ),
            80 => 
            array (
                'domain_id' => 16,
                'id' => 90,
                'name' => 'Montage du dossier de crédit ',
            ),
            81 => 
            array (
                'domain_id' => 16,
                'id' => 91,
                'name' => 'Etude et sanction du dossier de crédit',
            ),
            82 => 
            array (
                'domain_id' => 16,
                'id' => 92,
                'name' => 'Recueil des garanties à priori',
            ),
            83 => 
            array (
                'domain_id' => 16,
                'id' => 93,
                'name' => 'Déblocage de fonds ',
            ),
            84 => 
            array (
                'domain_id' => 16,
                'id' => 94,
                'name' => 'Recueil des garanties à postériori',
            ),
            85 => 
            array (
                'domain_id' => 16,
                'id' => 95,
                'name' => 'Suivi des engagements ',
            ),
            86 => 
            array (
                'domain_id' => 16,
                'id' => 96,
                'name' => 'Décès du client détenteur d\'un crédit',
            ),
            87 => 
            array (
                'domain_id' => 16,
                'id' => 97,
                'name' => 'Report d\'échéance ou rééchelonnement ',
            ),
            88 => 
            array (
                'domain_id' => 17,
                'id' => 98,
                'name' => 'Montage du dossier de crédit ',
            ),
            89 => 
            array (
                'domain_id' => 17,
                'id' => 99,
                'name' => 'Etude et sanction du dossier de crédit',
            ),
            90 => 
            array (
                'domain_id' => 17,
                'id' => 100,
                'name' => 'Recueil des garanties à priori',
            ),
            91 => 
            array (
                'domain_id' => 17,
                'id' => 101,
                'name' => 'Déblocage de fonds ',
            ),
            92 => 
            array (
                'domain_id' => 17,
                'id' => 102,
                'name' => 'Recueil et suivi des garanties à postériori',
            ),
            93 => 
            array (
                'domain_id' => 17,
                'id' => 103,
                'name' => 'Suivi des engagements',
            ),
            94 => 
            array (
                'domain_id' => 17,
                'id' => 104,
                'name' => 'Décès du client détenteur d\'un crédit',
            ),
            95 => 
            array (
                'domain_id' => 17,
                'id' => 105,
                'name' => 'Report d\'échéance ou rééchelonnement ',
            ),
            96 => 
            array (
                'domain_id' => 18,
                'id' => 106,
                'name' => 'Montage du dossier de crédit ',
            ),
            97 => 
            array (
                'domain_id' => 18,
                'id' => 107,
                'name' => 'Etude et sanction du dossier de crédit',
            ),
            98 => 
            array (
                'domain_id' => 18,
                'id' => 108,
                'name' => 'Recueil des garanties à priori ',
            ),
            99 => 
            array (
                'domain_id' => 18,
                'id' => 109,
                'name' => 'Déblocage de fonds ',
            ),
            100 => 
            array (
                'domain_id' => 18,
                'id' => 110,
                'name' => 'Suivi des engagements',
            ),
            101 => 
            array (
                'domain_id' => 18,
                'id' => 111,
                'name' => 'Décès du client détenteur d\'un crédit',
            ),
            102 => 
            array (
                'domain_id' => 19,
                'id' => 112,
                'name' => 'Montage du dossier de crédit ',
            ),
            103 => 
            array (
                'domain_id' => 19,
                'id' => 113,
                'name' => 'Etude et sanction du dossier de crédit',
            ),
            104 => 
            array (
                'domain_id' => 19,
                'id' => 114,
                'name' => 'Recueil des garanties à priori  ',
            ),
            105 => 
            array (
                'domain_id' => 19,
                'id' => 115,
                'name' => 'Déblocage de fonds ',
            ),
            106 => 
            array (
                'domain_id' => 19,
                'id' => 116,
                'name' => 'Recueil et suivi des garanties à postériori   ',
            ),
            107 => 
            array (
                'domain_id' => 19,
                'id' => 117,
                'name' => 'Suivi des engagements',
            ),
            108 => 
            array (
                'domain_id' => 19,
                'id' => 118,
                'name' => 'Décès du client détenteur d\'un crédit',
            ),
            109 => 
            array (
                'domain_id' => 19,
                'id' => 119,
                'name' => 'Report d\'échéance ou rééchelonnement ',
            ),
            110 => 
            array (
                'domain_id' => 20,
                'id' => 120,
                'name' => 'Recouvrement précontentieux ',
            ),
            111 => 
            array (
                'domain_id' => 20,
                'id' => 121,
                'name' => 'Recouvrement contentieux',
            ),
            112 => 
            array (
                'domain_id' => 20,
                'id' => 122,
                'name' => 'Recouvrement dispositifs aidées ',
            ),
            113 => 
            array (
                'domain_id' => 21,
                'id' => 123,
                'name' => 'Pré domicliation et domiciliation ',
            ),
            114 => 
            array (
                'domain_id' => 21,
                'id' => 124,
                'name' => 'Crédit documentaire  ',
            ),
            115 => 
            array (
                'domain_id' => 22,
                'id' => 125,
                'name' => 'Pré domicliation et domiciliation ',
            ),
            116 => 
            array (
                'domain_id' => 22,
                'id' => 126,
                'name' => 'Remise documentaire ',
            ),
            117 => 
            array (
                'domain_id' => 23,
                'id' => 127,
                'name' => 'Transfert libre',
            ),
            118 => 
            array (
                'domain_id' => 24,
                'id' => 128,
                'name' => 'Déclaration des dossiers ',
            ),
            119 => 
            array (
                'domain_id' => 24,
                'id' => 129,
                'name' => 'Apurement des dossiers',
            ),
        ));
        
        
    }
}