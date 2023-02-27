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
                'id' => 462,
                'name' => 'Pré domicliation et domiciliation ',
                'domain_id' => 1,
            ),
            1 => 
            array (
                'id' => 463,
                'name' => 'Crédit documentaire  ',
                'domain_id' => 2,
            ),
            2 => 
            array (
                'id' => 464,
                'name' => 'Remise documentaire ',
                'domain_id' => 3,
            ),
            3 => 
            array (
                'id' => 465,
                'name' => 'Transfert libre',
                'domain_id' => 4,
            ),
            4 => 
            array (
                'id' => 466,
                'name' => 'Déclaration des dossiers ',
                'domain_id' => 5,
            ),
            5 => 
            array (
                'id' => 467,
                'name' => 'Apurement des dossiers',
                'domain_id' => 5,
            ),
            6 => 
            array (
                'id' => 468,
                'name' => 'Arrêté de caisse Dinars et devises',
                'domain_id' => 6,
            ),
            7 => 
            array (
                'id' => 469,
                'name' => 'Arrêté de la caisse DAB et GAB',
                'domain_id' => 6,
            ),
            8 => 
            array (
                'id' => 470,
                'name' => 'Envoi et réception de fonds ',
                'domain_id' => 6,
            ),
            9 => 
            array (
                'id' => 471,
                'name' => 'Journée comptable ',
                'domain_id' => 6,
            ),
            10 => 
            array (
                'id' => 472,
                'name' => 'Vérification des opérations de retrait sur chèque et livret ',
                'domain_id' => 7,
            ),
            11 => 
            array (
                'id' => 473,
                'name' => 'Vérification des opérations sur comptes devises',
                'domain_id' => 7,
            ),
            12 => 
            array (
                'id' => 474,
                'name' => 'Vérification des opérations de versement Dinars et devises ',
                'domain_id' => 7,
            ),
            13 => 
            array (
                'id' => 475,
                'name' => 'Gestion d\'un contrat E-Banking',
                'domain_id' => 8,
            ),
            14 => 
            array (
                'id' => 476,
                'name' => 'Traitement des réclamations',
                'domain_id' => 8,
            ),
            15 => 
            array (
                'id' => 477,
                'name' => 'Virements de compte à compte ',
                'domain_id' => 8,
            ),
            16 => 
            array (
                'id' => 478,
                'name' => 'Virements par EDI ',
                'domain_id' => 8,
            ),
            17 => 
            array (
                'id' => 479,
                'name' => 'Ouverture de compte ',
                'domain_id' => 9,
            ),
            18 => 
            array (
                'id' => 480,
                'name' => 'Clôture de compte à l\'initiative du client ',
                'domain_id' => 9,
            ),
            19 => 
            array (
                'id' => 481,
                'name' => 'Compte sans mouvements ',
                'domain_id' => 9,
            ),
            20 => 
            array (
                'id' => 482,
                'name' => 'Gestion des Bons de caisse',
                'domain_id' => 10,
            ),
            21 => 
            array (
                'id' => 483,
                'name' => 'Souscription du BDC Nominatif ou Anonyme ',
                'domain_id' => 10,
            ),
            22 => 
            array (
                'id' => 484,
                'name' => 'Remboursement du BDC ',
                'domain_id' => 10,
            ),
            23 => 
            array (
                'id' => 485,
                'name' => 'Souscription du DAT dinars et devises ',
                'domain_id' => 11,
            ),
            24 => 
            array (
                'id' => 486,
                'name' => 'Remboursement du DAT  ',
                'domain_id' => 11,
            ),
            25 => 
            array (
                'id' => 487,
                'name' => 'Gestion des carnets de chèques clientèle  ',
                'domain_id' => 12,
            ),
            26 => 
            array (
                'id' => 488,
                'name' => 'Gestion des carnets de chèques de banque',
                'domain_id' => 12,
            ),
            27 => 
            array (
                'id' => 489,
                'name' => 'Gestion des bons de caisse',
                'domain_id' => 12,
            ),
            28 => 
            array (
                'id' => 490,
                'name' => 'Gestion des livrets épargne ',
                'domain_id' => 12,
            ),
            29 => 
            array (
                'id' => 491,
                'name' => 'Gestion des coffres forts',
                'domain_id' => 12,
            ),
            30 => 
            array (
                'id' => 492,
                'name' => 'Chèque de banque ',
                'domain_id' => 13,
            ),
            31 => 
            array (
                'id' => 493,
                'name' => 'Prélèvement ',
                'domain_id' => 13,
            ),
            32 => 
            array (
                'id' => 494,
                'name' => 'Effet de commerce ',
                'domain_id' => 13,
            ),
            33 => 
            array (
                'id' => 495,
                'name' => 'Virements RTGS ',
                'domain_id' => 13,
            ),
            34 => 
            array (
                'id' => 496,
                'name' => 'Virements émis ',
                'domain_id' => 13,
            ),
            35 => 
            array (
                'id' => 497,
                'name' => 'Gestion des cartes bancaires et codes confidentiels',
                'domain_id' => 14,
            ),
            36 => 
            array (
                'id' => 498,
                'name' => 'Remplacement d\'une carte CIB ',
                'domain_id' => 14,
            ),
            37 => 
            array (
                'id' => 499,
                'name' => 'Annulation d\'une carte CIB ',
                'domain_id' => 14,
            ),
            38 => 
            array (
                'id' => 500,
                'name' => 'Réédition du code confidentiel ',
                'domain_id' => 14,
            ),
            39 => 
            array (
                'id' => 501,
                'name' => 'Modification du plafond de retrait/paiement d\'une carte ',
                'domain_id' => 14,
            ),
            40 => 
            array (
                'id' => 502,
                'name' => 'Mise en exception d\'une carte CIB ',
                'domain_id' => 14,
            ),
            41 => 
            array (
                'id' => 503,
                'name' => 'Gestion des TPE ',
                'domain_id' => 14,
            ),
            42 => 
            array (
                'id' => 504,
                'name' => 'Traitement et règlement des litiges monétiques porteurs de cartes',
                'domain_id' => 14,
            ),
            43 => 
            array (
                'id' => 505,
                'name' => 'E-Paiement  ',
                'domain_id' => 14,
            ),
            44 => 
            array (
                'id' => 506,
                'name' => 'Mobil GAB ',
                'domain_id' => 14,
            ),
            45 => 
            array (
                'id' => 507,
                'name' => 'Traitement des allocations touristiques',
                'domain_id' => 15,
            ),
            46 => 
            array (
                'id' => 508,
                'name' => 'Traitement des frais de mission à l\'étranger',
                'domain_id' => 15,
            ),
            47 => 
            array (
                'id' => 509,
                'name' => 'Traitement des frais de scolarités courte durée',
                'domain_id' => 15,
            ),
            48 => 
            array (
                'id' => 510,
                'name' => 'Traitement des frais de soins à l\'étranger ',
                'domain_id' => 15,
            ),
            49 => 
            array (
                'id' => 511,
                'name' => 'Cession de devises par le client ',
                'domain_id' => 15,
            ),
            50 => 
            array (
                'id' => 512,
            'name' => 'Avis à tiers détenteurs (ATD)/ Opposition des organismes sociaux ',
                'domain_id' => 16,
            ),
            51 => 
            array (
                'id' => 513,
            'name' => 'Saisies arrêts (Emises, reçues)',
                'domain_id' => 16,
            ),
            52 => 
            array (
                'id' => 514,
                'name' => 'Opposition sur chèque, chèque de banque, livret, BDC',
                'domain_id' => 16,
            ),
            53 => 
            array (
                'id' => 515,
                'name' => 'Incidents de paiements',
                'domain_id' => 16,
            ),
            54 => 
            array (
                'id' => 516,
                'name' => 'Succession ',
                'domain_id' => 16,
            ),
            55 => 
            array (
                'id' => 517,
                'name' => 'FATCA ',
                'domain_id' => 17,
            ),
            56 => 
            array (
                'id' => 518,
                'name' => 'LAB- FT ',
                'domain_id' => 18,
            ),
            57 => 
            array (
                'id' => 519,
                'name' => 'Montage du dossier de crédit ',
                'domain_id' => 19,
            ),
            58 => 
            array (
                'id' => 520,
                'name' => 'Etude et sanction du dossier de crédit',
                'domain_id' => 19,
            ),
            59 => 
            array (
                'id' => 521,
                'name' => 'Recueil des garanties à priori',
                'domain_id' => 19,
            ),
            60 => 
            array (
                'id' => 522,
                'name' => 'Déblocage de fonds ',
                'domain_id' => 19,
            ),
            61 => 
            array (
                'id' => 523,
                'name' => 'Recueil et suivi des garanties à posteriori',
                'domain_id' => 19,
            ),
            62 => 
            array (
                'id' => 524,
                'name' => 'Suivi des engagements',
                'domain_id' => 19,
            ),
            63 => 
            array (
                'id' => 525,
                'name' => 'Montage du dossier de crédit ',
                'domain_id' => 20,
            ),
            64 => 
            array (
                'id' => 526,
                'name' => 'Etude et sanction du dossier de crédit',
                'domain_id' => 20,
            ),
            65 => 
            array (
                'id' => 527,
                'name' => 'Recueil des garanties à priori',
                'domain_id' => 20,
            ),
            66 => 
            array (
                'id' => 528,
                'name' => 'Déblocage de fonds ',
                'domain_id' => 20,
            ),
            67 => 
            array (
                'id' => 529,
                'name' => 'Suivi des engagements ',
                'domain_id' => 20,
            ),
            68 => 
            array (
                'id' => 530,
                'name' => 'Montage du dossier de crédit ',
                'domain_id' => 21,
            ),
            69 => 
            array (
                'id' => 531,
                'name' => 'Etude et sanction du dossier de crédit',
                'domain_id' => 21,
            ),
            70 => 
            array (
                'id' => 532,
                'name' => 'Recueil des garanties à priori',
                'domain_id' => 21,
            ),
            71 => 
            array (
                'id' => 533,
                'name' => 'Déblocage de fonds ',
                'domain_id' => 21,
            ),
            72 => 
            array (
                'id' => 534,
                'name' => 'Receuil et Suivi des garanties à postériori ',
                'domain_id' => 21,
            ),
            73 => 
            array (
                'id' => 535,
                'name' => 'Suivi des engagements',
                'domain_id' => 21,
            ),
            74 => 
            array (
                'id' => 536,
                'name' => 'Montage du dossier de crédit ',
                'domain_id' => 22,
            ),
            75 => 
            array (
                'id' => 537,
                'name' => 'Etude et sanction du dossier de crédit',
                'domain_id' => 22,
            ),
            76 => 
            array (
                'id' => 538,
                'name' => 'Recueil des garanties à priori',
                'domain_id' => 22,
            ),
            77 => 
            array (
                'id' => 539,
                'name' => 'Recueil et suivi des garanties à posteriori',
                'domain_id' => 22,
            ),
            78 => 
            array (
                'id' => 540,
                'name' => 'Suivi des engagements',
                'domain_id' => 22,
            ),
            79 => 
            array (
                'id' => 541,
                'name' => 'Montage du dossier de crédit ',
                'domain_id' => 23,
            ),
            80 => 
            array (
                'id' => 542,
                'name' => 'Etude et sanction du dossier de crédit',
                'domain_id' => 23,
            ),
            81 => 
            array (
                'id' => 543,
                'name' => 'Recueil des garanties à priori',
                'domain_id' => 23,
            ),
            82 => 
            array (
                'id' => 544,
                'name' => 'Déblocage de fonds ',
                'domain_id' => 23,
            ),
            83 => 
            array (
                'id' => 545,
                'name' => 'Recueil des garanties à postériori',
                'domain_id' => 23,
            ),
            84 => 
            array (
                'id' => 546,
                'name' => 'Suivi des engagements ',
                'domain_id' => 23,
            ),
            85 => 
            array (
                'id' => 547,
                'name' => 'Montage du dossier de crédit ',
                'domain_id' => 24,
            ),
            86 => 
            array (
                'id' => 548,
                'name' => 'Etude et sanction du dossier de crédit',
                'domain_id' => 24,
            ),
            87 => 
            array (
                'id' => 549,
                'name' => 'Recueil des garanties à priori',
                'domain_id' => 24,
            ),
            88 => 
            array (
                'id' => 550,
                'name' => 'Déblocage de fonds ',
                'domain_id' => 24,
            ),
            89 => 
            array (
                'id' => 551,
                'name' => 'Recueil et suivi des garanties à postériori',
                'domain_id' => 24,
            ),
            90 => 
            array (
                'id' => 552,
                'name' => 'Suivi des engagements',
                'domain_id' => 24,
            ),
            91 => 
            array (
                'id' => 553,
                'name' => 'Montage du dossier de crédit ',
                'domain_id' => 25,
            ),
            92 => 
            array (
                'id' => 554,
                'name' => 'Etude et sanction du dossier de crédit',
                'domain_id' => 25,
            ),
            93 => 
            array (
                'id' => 555,
                'name' => 'Recueil des garanties à priori ',
                'domain_id' => 25,
            ),
            94 => 
            array (
                'id' => 556,
                'name' => 'Déblocage de fonds ',
                'domain_id' => 25,
            ),
            95 => 
            array (
                'id' => 557,
                'name' => 'Suivi des engagements',
                'domain_id' => 25,
            ),
            96 => 
            array (
                'id' => 558,
                'name' => 'Montage du dossier de crédit ',
                'domain_id' => 26,
            ),
            97 => 
            array (
                'id' => 559,
                'name' => 'Etude et sanction du dossier de crédit',
                'domain_id' => 26,
            ),
            98 => 
            array (
                'id' => 560,
                'name' => 'Recueil des garanties à priori  ',
                'domain_id' => 26,
            ),
            99 => 
            array (
                'id' => 561,
                'name' => 'Déblocage de fonds ',
                'domain_id' => 26,
            ),
            100 => 
            array (
                'id' => 562,
                'name' => 'Recueil et suivi des garanties à postériori   ',
                'domain_id' => 26,
            ),
            101 => 
            array (
                'id' => 563,
                'name' => 'Suivi des engagements',
                'domain_id' => 26,
            ),
            102 => 
            array (
                'id' => 564,
                'name' => 'Suivi des comptes financiers',
                'domain_id' => 27,
            ),
            103 => 
            array (
                'id' => 565,
                'name' => 'Suivi des comptes internes',
                'domain_id' => 27,
            ),
            104 => 
            array (
                'id' => 566,
                'name' => 'Suivi des liaison siège',
                'domain_id' => 27,
            ),
            105 => 
            array (
                'id' => 567,
                'name' => 'Suivi du budget ',
                'domain_id' => 28,
            ),
            106 => 
            array (
                'id' => 568,
                'name' => 'Compte CCP ',
                'domain_id' => 29,
            ),
            107 => 
            array (
                'id' => 569,
                'name' => 'Compte Trésor public ',
                'domain_id' => 29,
            ),
            108 => 
            array (
                'id' => 570,
                'name' => 'Compte Banque d\'algérie ',
                'domain_id' => 29,
            ),
            109 => 
            array (
                'id' => 571,
                'name' => 'Gestion des habilitations ',
                'domain_id' => 30,
            ),
            110 => 
            array (
                'id' => 572,
                'name' => 'Avance sur appointement/salaire ',
                'domain_id' => 30,
            ),
            111 => 
            array (
                'id' => 573,
                'name' => 'Gestion des congés annuels ',
                'domain_id' => 30,
            ),
            112 => 
            array (
                'id' => 574,
                'name' => 'Gestion des absences longue durée ',
                'domain_id' => 30,
            ),
            113 => 
            array (
                'id' => 575,
                'name' => 'Tenue des livres légaux ',
                'domain_id' => 30,
            ),
            114 => 
            array (
                'id' => 576,
                'name' => 'Commercialisation des produits d\'assurance',
                'domain_id' => 31,
            ),
            115 => 
            array (
                'id' => 577,
                'name' => 'Assurance des fonds',
                'domain_id' => 32,
            ),
            116 => 
            array (
                'id' => 578,
                'name' => 'Sécurité et protection des personnes et des biens',
                'domain_id' => 32,
            ),
        ));
        
        
    }
}