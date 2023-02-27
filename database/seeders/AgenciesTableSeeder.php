<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AgenciesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('agencies')->delete();
        
        \DB::table('agencies')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Agence TOLGA',
                'code' => 709,
                'dre_id' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Agence BISKRA "A"',
                'code' => 386,
                'dre_id' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Agence BISKRA "C"',
                'code' => 387,
                'dre_id' => 1,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => '-AP BATNA "A"',
                'code' => 335,
                'dre_id' => 1,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Agence BATNA',
                'code' => 336,
                'dre_id' => 1,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Agence BARIKA',
                'code' => 340,
                'dre_id' => 1,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Agence EL OUED',
                'code' => 710,
                'dre_id' => 1,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Agence Zeribet El Oued',
                'code' => 713,
                'dre_id' => 1,
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Agence ADRAR',
                'code' => 250,
                'dre_id' => 2,
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Agence TMIMOUN',
                'code' => 251,
                'dre_id' => 2,
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Agence BENI OUNIF',
                'code' => 410,
                'dre_id' => 2,
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Agence TINDOUF',
                'code' => 411,
                'dre_id' => 2,
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'AP BECHAR',
                'code' => 412,
                'dre_id' => 2,
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'Agence AOULEF',
                'code' => 413,
                'dre_id' => 2,
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'Agence DEBDABA',
                'code' => 414,
                'dre_id' => 2,
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'Agence BECHAR',
                'code' => 415,
                'dre_id' => 2,
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'AP TLEMCEN',
                'code' => 512,
                'dre_id' => 3,
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'Agence MAGHNIA',
                'code' => 514,
                'dre_id' => 3,
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'AP ABOU TACHFINE',
                'code' => 526,
                'dre_id' => 3,
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'Agence BENI SAF',
                'code' => 525,
                'dre_id' => 3,
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'Agence NEDROMA',
                'code' => 529,
                'dre_id' => 3,
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'Agence HENNAYA',
                'code' => 531,
                'dre_id' => 3,
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'Agence KIFANE',
                'code' => 533,
                'dre_id' => 3,
            ),
            23 => 
            array (
                'id' => 25,
                'name' => 'AP TLEMCEN 2',
                'code' => 527,
                'dre_id' => 3,
            ),
            24 => 
            array (
                'id' => 26,
                'name' => 'Agence SEBDOU',
                'code' => 528,
                'dre_id' => 3,
            ),
            25 => 
            array (
                'id' => 27,
                'name' => 'Agence REMCHI',
                'code' => 530,
                'dre_id' => 3,
            ),
            26 => 
            array (
                'id' => 28,
                'name' => 'Agence GHAZAOUAT',
                'code' => 532,
                'dre_id' => 3,
            ),
            27 => 
            array (
                'id' => 29,
                'name' => 'Agence MECHERIA',
                'code' => 725,
                'dre_id' => 3,
            ),
            28 => 
            array (
                'id' => 30,
                'name' => 'Agence Am Sefra',
                'code' => 727,
                'dre_id' => 3,
            ),
            29 => 
            array (
                'id' => 31,
                'name' => 'Agence NAAMA',
                'code' => 730,
                'dre_id' => 3,
            ),
            30 => 
            array (
                'id' => 32,
                'name' => 'Agence HAI ESSALEM',
                'code' => 900,
                'dre_id' => 4,
            ),
            31 => 
            array (
                'id' => 33,
                'name' => 'AP ORAN SOUMMAM',
                'code' => 951,
                'dre_id' => 4,
            ),
            32 => 
            array (
                'id' => 34,
                'name' => 'Agence ORAN "Boulanger"',
                'code' => 952,
                'dre_id' => 4,
            ),
            33 => 
            array (
                'id' => 35,
                'name' => 'Agence ORAN BEN M\'HIDI',
                'code' => 953,
                'dre_id' => 4,
            ),
            34 => 
            array (
                'id' => 36,
                'name' => 'Agence ARZEW',
                'code' => 954,
                'dre_id' => 4,
            ),
            35 => 
            array (
                'id' => 37,
                'name' => 'Agence MISSERGHIN',
                'code' => 955,
                'dre_id' => 4,
            ),
            36 => 
            array (
                'id' => 38,
                'name' => 'Agence ST EUGENE',
                'code' => 957,
                'dre_id' => 4,
            ),
            37 => 
            array (
                'id' => 39,
                'name' => 'Agence PLATEAU',
                'code' => 958,
                'dre_id' => 4,
            ),
            38 => 
            array (
                'id' => 40,
                'name' => 'AP ORAN Djillali',
                'code' => 960,
                'dre_id' => 4,
            ),
            39 => 
            array (
                'id' => 41,
                'name' => 'Agence AEROPORT',
                'code' => 962,
                'dre_id' => 4,
            ),
            40 => 
            array (
                'id' => 42,
                'name' => 'Agence OUEO TIELAT',
                'code' => 963,
                'dre_id' => 4,
            ),
            41 => 
            array (
                'id' => 43,
                'name' => 'Agence ES-SENIA Ville',
                'code' => 965,
                'dre_id' => 4,
            ),
            42 => 
            array (
                'id' => 44,
                'name' => 'AP ORAN sidi el houari',
                'code' => 966,
                'dre_id' => 4,
            ),
            43 => 
            array (
                'id' => 45,
                'name' => 'Agence AÎN EL TURCK',
                'code' => 967,
                'dre_id' => 4,
            ),
            44 => 
            array (
                'id' => 46,
                'name' => 'Agence Renault O/Tlelat',
                'code' => 969,
                'dre_id' => 4,
            ),
            45 => 
            array (
                'id' => 47,
                'name' => 'Agence BOUIRA',
                'code' => 460,
                'dre_id' => 5,
            ),
            46 => 
            array (
                'id' => 48,
                'name' => 'Agence AZAZGA',
                'code' => 462,
                'dre_id' => 5,
            ),
            47 => 
            array (
                'id' => 49,
                'name' => 'Agence LAKHDARIA',
                'code' => 576,
                'dre_id' => 5,
            ),
            48 => 
            array (
                'id' => 50,
                'name' => 'Agence BOGHNI',
                'code' => 577,
                'dre_id' => 5,
            ),
            49 => 
            array (
                'id' => 51,
                'name' => 'Agence Larbâa Nathlrathen',
                'code' => 578,
                'dre_id' => 5,
            ),
            50 => 
            array (
                'id' => 52,
                'name' => 'Agence BORDJ MENAIEL',
                'code' => 643,
                'dre_id' => 5,
            ),
            51 => 
            array (
                'id' => 53,
                'name' => 'AP TIZI OUZOU',
                'code' => 581,
                'dre_id' => 5,
            ),
            52 => 
            array (
                'id' => 54,
                'name' => 'Agence LES OUAOHIAS',
                'code' => 582,
                'dre_id' => 5,
            ),
            53 => 
            array (
                'id' => 56,
                'name' => 'AP TIZI OUZOU 2',
                'code' => 583,
                'dre_id' => 5,
            ),
            54 => 
            array (
                'id' => 57,
                'name' => 'Agence DRAA BEN KHEDDA',
                'code' => 584,
                'dre_id' => 5,
            ),
            55 => 
            array (
                'id' => 58,
                'name' => 'Agence DELLYS',
                'code' => 642,
                'dre_id' => 5,
            ),
            56 => 
            array (
                'id' => 59,
                'name' => 'Agonce TIZI OUZOU',
                'code' => 580,
                'dre_id' => 5,
            ),
            57 => 
            array (
                'id' => 60,
                'name' => 'Agence GHARDAIA',
                'code' => 291,
                'dre_id' => 6,
            ),
            58 => 
            array (
                'id' => 62,
                'name' => 'Agence GHARDAÏA 2',
                'code' => 292,
                'dre_id' => 6,
            ),
            59 => 
            array (
                'id' => 63,
                'name' => 'Agence BERRIANE',
                'code' => 294,
                'dre_id' => 6,
            ),
            60 => 
            array (
                'id' => 64,
                'name' => 'Agence GUERRARA',
                'code' => 295,
                'dre_id' => 6,
            ),
            61 => 
            array (
                'id' => 65,
                'name' => 'Agence METLILI CHAAMBA',
                'code' => 296,
                'dre_id' => 6,
            ),
            62 => 
            array (
                'id' => 66,
                'name' => 'Agence AFLOU',
                'code' => 297,
                'dre_id' => 6,
            ),
            63 => 
            array (
                'id' => 67,
                'name' => 'AP LAGHOUAT',
                'code' => 301,
                'dre_id' => 6,
            ),
            64 => 
            array (
                'id' => 68,
                'name' => 'Agence TAMANRASSET',
                'code' => 473,
                'dre_id' => 6,
            ),
            65 => 
            array (
                'id' => 69,
                'name' => 'Agence TOUGGOURT',
                'code' => 941,
                'dre_id' => 6,
            ),
            66 => 
            array (
                'id' => 70,
                'name' => 'Agence OUARGLA "B"',
                'code' => 943,
                'dre_id' => 6,
            ),
            67 => 
            array (
                'id' => 71,
                'name' => 'Agence OUARGLA',
                'code' => 944,
                'dre_id' => 6,
            ),
            68 => 
            array (
                'id' => 72,
                'name' => 'Agence DJANET',
                'code' => 945,
                'dre_id' => 6,
            ),
            69 => 
            array (
                'id' => 73,
                'name' => 'AP OUARGLA',
                'code' => 946,
                'dre_id' => 6,
            ),
            70 => 
            array (
                'id' => 74,
                'name' => 'Agence HASSI MESSAOUD',
                'code' => 947,
                'dre_id' => 6,
            ),
            71 => 
            array (
                'id' => 75,
                'name' => 'Agence Illizi',
                'code' => 948,
                'dre_id' => 6,
            ),
            72 => 
            array (
                'id' => 76,
                'name' => 'Agence CONSTANTINE PYRAMIDE',
                'code' => 832,
                'dre_id' => 7,
            ),
            73 => 
            array (
                'id' => 77,
                'name' => 'Agence TADJE-NANET',
                'code' => 833,
                'dre_id' => 7,
            ),
            74 => 
            array (
                'id' => 78,
                'name' => 'Agence EL KHROUB',
                'code' => 835,
                'dre_id' => 7,
            ),
            75 => 
            array (
                'id' => 79,
                'name' => 'AP AIN SMARA',
                'code' => 840,
                'dre_id' => 7,
            ),
            76 => 
            array (
                'id' => 80,
                'name' => 'Agence EL MILIA',
                'code' => 841,
                'dre_id' => 7,
            ),
            77 => 
            array (
                'id' => 81,
                'name' => 'Agence Chelghoum El Aïd',
                'code' => 843,
                'dre_id' => 7,
            ),
            78 => 
            array (
                'id' => 82,
                'name' => 'Agence DAKSI "C"',
                'code' => 844,
                'dre_id' => 7,
            ),
            79 => 
            array (
                'id' => 83,
                'name' => 'AP CONSTANTINE ',
                'code' => 845,
                'dre_id' => 7,
            ),
            80 => 
            array (
                'id' => 84,
                'name' => 'Agence MILA',
                'code' => 846,
                'dre_id' => 7,
            ),
            81 => 
            array (
                'id' => 85,
                'name' => 'Agence HAMMA BOUZIANE',
                'code' => 848,
                'dre_id' => 7,
            ),
            82 => 
            array (
                'id' => 86,
                'name' => 'AP FILLALI',
                'code' => 850,
                'dre_id' => 7,
            ),
            83 => 
            array (
                'id' => 87,
                'name' => 'Agence AIN EL BEY',
                'code' => 834,
                'dre_id' => 7,
            ),
            84 => 
            array (
                'id' => 88,
                'name' => 'Agence ANNABA',
                'code' => 482,
                'dre_id' => 8,
            ),
            85 => 
            array (
                'id' => 89,
                'name' => 'Agence AZZABA',
                'code' => 485,
                'dre_id' => 8,
            ),
            86 => 
            array (
                'id' => 90,
                'name' => 'Agence COLLO',
                'code' => 487,
                'dre_id' => 8,
            ),
            87 => 
            array (
                'id' => 91,
                'name' => 'Agence EL TARF',
                'code' => 489,
                'dre_id' => 8,
            ),
            88 => 
            array (
                'id' => 92,
                'name' => 'Agence OUED ZEN ATI',
                'code' => 488,
                'dre_id' => 8,
            ),
            89 => 
            array (
                'id' => 93,
                'name' => 'AP SKIKDA',
                'code' => 743,
                'dre_id' => 8,
            ),
            90 => 
            array (
                'id' => 94,
                'name' => 'Agence SKIKDA',
                'code' => 744,
                'dre_id' => 8,
            ),
            91 => 
            array (
                'id' => 95,
                'name' => 'AP ANNABA',
                'code' => 810,
                'dre_id' => 8,
            ),
            92 => 
            array (
                'id' => 97,
                'name' => 'AP ANNABA 2',
                'code' => 811,
                'dre_id' => 8,
            ),
            93 => 
            array (
                'id' => 98,
                'name' => 'Agence EL KALA',
                'code' => 812,
                'dre_id' => 8,
            ),
            94 => 
            array (
                'id' => 99,
                'name' => 'Agence ANNABA "B"',
                'code' => 813,
                'dre_id' => 8,
            ),
            95 => 
            array (
                'id' => 100,
                'name' => 'Agence SOUK AHRAS',
                'code' => 814,
                'dre_id' => 8,
            ),
            96 => 
            array (
                'id' => 101,
                'name' => 'Agence EL BOUNI',
                'code' => 815,
                'dre_id' => 8,
            ),
            97 => 
            array (
                'id' => 102,
                'name' => 'Agence GUELMA',
                'code' => 816,
                'dre_id' => 8,
            ),
            98 => 
            array (
                'id' => 103,
                'name' => 'Agence DAR EL BEIDA',
                'code' => 612,
                'dre_id' => 9,
            ),
            99 => 
            array (
                'id' => 104,
                'name' => 'Agence Aéroport HB',
                'code' => 613,
                'dre_id' => 9,
            ),
            100 => 
            array (
                'id' => 105,
                'name' => 'AP EL HARRACH',
                'code' => 616,
                'dre_id' => 9,
            ),
            101 => 
            array (
                'id' => 106,
                'name' => 'Agence EL HARRACH',
                'code' => 619,
                'dre_id' => 9,
            ),
            102 => 
            array (
                'id' => 107,
                'name' => 'Agence PINS MARITIMES',
                'code' => 624,
                'dre_id' => 9,
            ),
            103 => 
            array (
                'id' => 108,
                'name' => 'Agence KOUBA',
                'code' => 625,
                'dre_id' => 9,
            ),
            104 => 
            array (
                'id' => 109,
                'name' => 'AP OUED SMAR',
                'code' => 634,
                'dre_id' => 9,
            ),
            105 => 
            array (
                'id' => 110,
                'name' => 'Agence BARAKI',
                'code' => 636,
                'dre_id' => 9,
            ),
            106 => 
            array (
                'id' => 111,
                'name' => 'Agence GUE DE CONSTANTINE',
                'code' => 637,
                'dre_id' => 9,
            ),
            107 => 
            array (
                'id' => 112,
                'name' => 'AP EL HAMIZ',
                'code' => 647,
                'dre_id' => 9,
            ),
            108 => 
            array (
                'id' => 113,
                'name' => 'Agence MOHAMMADIA',
                'code' => 648,
                'dre_id' => 9,
            ),
            109 => 
            array (
                'id' => 114,
                'name' => 'AP BIRKHADEM',
                'code' => 633,
                'dre_id' => 9,
            ),
            110 => 
            array (
                'id' => 115,
                'name' => 'Agence Birkhadem',
                'code' => 638,
                'dre_id' => 9,
            ),
            111 => 
            array (
                'id' => 116,
                'name' => 'Agence CHERCHELL',
                'code' => 427,
                'dre_id' => 10,
            ),
            112 => 
            array (
                'id' => 117,
                'name' => 'Agence ZERALDA',
                'code' => 428,
                'dre_id' => 10,
            ),
            113 => 
            array (
                'id' => 118,
                'name' => 'Agence BABA HACENE',
                'code' => 436,
                'dre_id' => 10,
            ),
            114 => 
            array (
                'id' => 119,
                'name' => 'Agence TIPAZA',
                'code' => 438,
                'dre_id' => 10,
            ),
            115 => 
            array (
                'id' => 120,
                'name' => 'Agence HADJOUT',
                'code' => 439,
                'dre_id' => 10,
            ),
            116 => 
            array (
                'id' => 121,
                'name' => 'Agence STAOUELI',
                'code' => 440,
                'dre_id' => 10,
            ),
            117 => 
            array (
                'id' => 122,
                'name' => 'AP KOLEA',
                'code' => 441,
                'dre_id' => 10,
            ),
            118 => 
            array (
                'id' => 123,
                'name' => 'Agence BOU ISMAIL',
                'code' => 444,
                'dre_id' => 10,
            ),
            119 => 
            array (
                'id' => 124,
                'name' => 'Agence AÏN BENIAN',
                'code' => 630,
                'dre_id' => 10,
            ),
            120 => 
            array (
                'id' => 125,
                'name' => 'AP BOUFARIK',
                'code' => 430,
                'dre_id' => 11,
            ),
            121 => 
            array (
                'id' => 126,
                'name' => 'Agence Blida',
                'code' => 431,
                'dre_id' => 11,
            ),
            122 => 
            array (
                'id' => 127,
                'name' => 'Agence EL AFFROUN',
                'code' => 437,
                'dre_id' => 11,
            ),
            123 => 
            array (
                'id' => 128,
                'name' => 'AP BLIDA',
                'code' => 442,
                'dre_id' => 11,
            ),
            124 => 
            array (
                'id' => 129,
                'name' => 'Agence LES BANANIERS',
                'code' => 445,
                'dre_id' => 11,
            ),
            125 => 
            array (
                'id' => 130,
                'name' => 'Agence AIN OUSSERA',
                'code' => 653,
                'dre_id' => 11,
            ),
            126 => 
            array (
                'id' => 131,
                'name' => 'AP DJELFA',
                'code' => 654,
                'dre_id' => 11,
            ),
            127 => 
            array (
                'id' => 132,
                'name' => 'Agence BERROUAGHIA',
                'code' => 849,
                'dre_id' => 11,
            ),
            128 => 
            array (
                'id' => 133,
                'name' => 'AP MEDEA',
                'code' => 851,
                'dre_id' => 11,
            ),
            129 => 
            array (
                'id' => 134,
                'name' => 'Agence KSAR EL BOUKHARI',
                'code' => 858,
                'dre_id' => 11,
            ),
            130 => 
            array (
                'id' => 135,
                'name' => 'AP ROUIBA',
                'code' => 632,
                'dre_id' => 12,
            ),
            131 => 
            array (
                'id' => 136,
                'name' => 'AP BORDJ EL KIFFAN',
                'code' => 640,
                'dre_id' => 12,
            ),
            132 => 
            array (
                'id' => 137,
                'name' => 'Agence THENIA',
                'code' => 631,
                'dre_id' => 12,
            ),
            133 => 
            array (
                'id' => 139,
                'name' => 'AP ROUIBA 2',
                'code' => 641,
                'dre_id' => 12,
            ),
            134 => 
            array (
                'id' => 140,
                'name' => 'CCD',
                'code' => 173,
                'dre_id' => 12,
            ),
            135 => 
            array (
                'id' => 141,
                'name' => 'Agence REGHAIA"1"',
                'code' => 644,
                'dre_id' => 12,
            ),
            136 => 
            array (
                'id' => 142,
                'name' => 'Agence BOUMERDES',
                'code' => 645,
                'dre_id' => 12,
            ),
            137 => 
            array (
                'id' => 143,
                'name' => 'Agence AIN TAYA',
                'code' => 646,
                'dre_id' => 12,
            ),
            138 => 
            array (
                'id' => 144,
                'name' => 'Agence EL HAMIZ',
                'code' => 649,
                'dre_id' => 12,
            ),
            139 => 
            array (
                'id' => 145,
                'name' => 'Agence REGHAIA “II"',
                'code' => 650,
                'dre_id' => 12,
            ),
            140 => 
            array (
                'id' => 146,
                'name' => 'Agence BORDJ EL BAHRI',
                'code' => 651,
                'dre_id' => 12,
            ),
            141 => 
            array (
                'id' => 147,
                'name' => 'AP BEJAIA',
                'code' => 356,
                'dre_id' => 13,
            ),
            142 => 
            array (
                'id' => 148,
                'name' => 'Agence EL KSEUR',
                'code' => 585,
                'dre_id' => 13,
            ),
            143 => 
            array (
                'id' => 149,
                'name' => 'Agence TAZMALT',
                'code' => 586,
                'dre_id' => 13,
            ),
            144 => 
            array (
                'id' => 150,
                'name' => 'Agence S.EL TENINE AOKAS',
                'code' => 589,
                'dre_id' => 13,
            ),
            145 => 
            array (
                'id' => 151,
                'name' => 'Agence IHADDADEN',
                'code' => 587,
                'dre_id' => 13,
            ),
            146 => 
            array (
                'id' => 152,
                'name' => 'Agence BEJAIA',
                'code' => 588,
                'dre_id' => 13,
            ),
            147 => 
            array (
                'id' => 153,
                'name' => 'Agence JIJEL',
                'code' => 671,
                'dre_id' => 13,
            ),
            148 => 
            array (
                'id' => 154,
                'name' => 'Bureau de change Soummam',
                'code' => 0,
                'dre_id' => 13,
            ),
            149 => 
            array (
                'id' => 155,
                'name' => 'Agence AKBOU',
                'code' => 590,
                'dre_id' => 13,
            ),
            150 => 
            array (
                'id' => 156,
                'name' => 'Agence KHENCHELA',
                'code' => 315,
                'dre_id' => 14,
            ),
            151 => 
            array (
                'id' => 157,
                'name' => 'Agence OUM EL BOUAGUI',
                'code' => 316,
                'dre_id' => 14,
            ),
            152 => 
            array (
                'id' => 158,
                'name' => 'Agence AIN BEIDA',
                'code' => 321,
                'dre_id' => 14,
            ),
            153 => 
            array (
                'id' => 160,
                'name' => 'Agence KHENCHELA 2',
                'code' => 323,
                'dre_id' => 14,
            ),
            154 => 
            array (
                'id' => 161,
                'name' => 'Agence AIN MLILA',
                'code' => 325,
                'dre_id' => 14,
            ),
            155 => 
            array (
                'id' => 162,
                'name' => 'AP TEBESSA',
                'code' => 491,
                'dre_id' => 14,
            ),
            156 => 
            array (
                'id' => 163,
                'name' => 'Agence TEBESSA',
                'code' => 483,
                'dre_id' => 14,
            ),
            157 => 
            array (
                'id' => 164,
                'name' => 'Agence OUENZA',
                'code' => 484,
                'dre_id' => 14,
            ),
            158 => 
            array (
                'id' => 165,
                'name' => 'Agence BIR ELATER',
                'code' => 486,
                'dre_id' => 14,
            ),
            159 => 
            array (
                'id' => 167,
                'name' => 'Agence Ain Beida 2',
                'code' => 800,
                'dre_id' => 14,
            ),
            160 => 
            array (
                'id' => 168,
                'name' => 'Agence OUM EL BOUAGHI',
                'code' => 842,
                'dre_id' => 14,
            ),
            161 => 
            array (
                'id' => 169,
                'name' => 'AP CHE GUEVARA',
                'code' => 599,
                'dre_id' => 15,
            ),
            162 => 
            array (
                'id' => 170,
                'name' => 'AP TELEMLY',
                'code' => 602,
                'dre_id' => 15,
            ),
            163 => 
            array (
                'id' => 171,
                'name' => 'AP LIBERTE',
                'code' => 605,
                'dre_id' => 15,
            ),
            164 => 
            array (
                'id' => 172,
                'name' => 'Agenoe BAB EL OUED',
                'code' => 629,
                'dre_id' => 15,
            ),
            165 => 
            array (
                'id' => 173,
                'name' => 'Caisse Centrale CHE "CCD"',
                'code' => 162,
                'dre_id' => 15,
            ),
            166 => 
            array (
                'id' => 174,
                'name' => 'AP ZIROUT YOUCEF',
                'code' => 620,
                'dre_id' => 15,
            ),
            167 => 
            array (
                'id' => 175,
                'name' => 'AP BOUZAREAH',
                'code' => 627,
                'dre_id' => 15,
            ),
            168 => 
            array (
                'id' => 176,
                'name' => 'Agence PORT-SAÏD',
                'code' => 628,
                'dre_id' => 15,
            ),
            169 => 
            array (
                'id' => 177,
                'name' => 'Agence BOLOGHINE',
                'code' => 608,
                'dre_id' => 15,
            ),
            170 => 
            array (
                'id' => 178,
                'name' => 'AP Didooche Mourad',
                'code' => 601,
                'dre_id' => 16,
            ),
            171 => 
            array (
                'id' => 179,
                'name' => 'Agence Hydra',
                'code' => 603,
                'dre_id' => 16,
            ),
            172 => 
            array (
                'id' => 180,
                'name' => 'Agence Hamani "B"',
                'code' => 607,
                'dre_id' => 16,
            ),
            173 => 
            array (
                'id' => 181,
                'name' => 'Agence "D"',
                'code' => 609,
                'dre_id' => 16,
            ),
            174 => 
            array (
                'id' => 182,
                'name' => 'AP Les Halles',
                'code' => 610,
                'dre_id' => 16,
            ),
            175 => 
            array (
                'id' => 183,
                'name' => 'AP Hussein Dey',
                'code' => 611,
                'dre_id' => 16,
            ),
            176 => 
            array (
                'id' => 184,
                'name' => 'Agence Hussein Dey',
                'code' => 635,
                'dre_id' => 16,
            ),
            177 => 
            array (
                'id' => 185,
                'name' => 'Agence "N"',
                'code' => 614,
                'dre_id' => 16,
            ),
            178 => 
            array (
                'id' => 186,
                'name' => 'Agence BELAHDJEL',
                'code' => 615,
                'dre_id' => 16,
            ),
            179 => 
            array (
                'id' => 187,
                'name' => 'Agence RIADH EL FETH',
                'code' => 617,
                'dre_id' => 16,
            ),
            180 => 
            array (
                'id' => 188,
                'name' => 'AP EL BIAR',
                'code' => 621,
                'dre_id' => 16,
            ),
            181 => 
            array (
                'id' => 189,
                'name' => 'Agence El Quods',
                'code' => 622,
                'dre_id' => 16,
            ),
            182 => 
            array (
                'id' => 190,
                'name' => 'AP Ben M\'hidi',
                'code' => 623,
                'dre_id' => 16,
            ),
            183 => 
            array (
                'id' => 191,
                'name' => 'AP AGHA',
                'code' => 626,
                'dre_id' => 16,
            ),
            184 => 
            array (
                'id' => 192,
                'name' => 'Agence CHLEF',
                'code' => 260,
                'dre_id' => 17,
            ),
            185 => 
            array (
                'id' => 193,
                'name' => 'Agence MILIANA',
                'code' => 262,
                'dre_id' => 17,
            ),
            186 => 
            array (
                'id' => 194,
                'name' => 'AP AIN DEFLA',
                'code' => 268,
                'dre_id' => 17,
            ),
            187 => 
            array (
                'id' => 195,
                'name' => 'Agence EL ATTAF',
                'code' => 272,
                'dre_id' => 17,
            ),
            188 => 
            array (
                'id' => 196,
                'name' => 'AP CHLEF',
                'code' => 275,
                'dre_id' => 17,
            ),
            189 => 
            array (
                'id' => 197,
                'name' => 'Agence OUED RHIOU',
                'code' => 276,
                'dre_id' => 17,
            ),
            190 => 
            array (
                'id' => 198,
                'name' => 'Agence TISSEMSILT',
                'code' => 277,
                'dre_id' => 17,
            ),
            191 => 
            array (
                'id' => 199,
                'name' => 'Agence KHEMIS MILIANA',
                'code' => 278,
                'dre_id' => 17,
            ),
            192 => 
            array (
                'id' => 200,
                'name' => 'Agence TENES',
                'code' => 279,
                'dre_id' => 17,
            ),
            193 => 
            array (
                'id' => 201,
                'name' => 'Agence Amoucha',
                'code' => 338,
                'dre_id' => 18,
            ),
            194 => 
            array (
                'id' => 202,
                'name' => 'Agence BOUSSAADA',
                'code' => 701,
                'dre_id' => 18,
            ),
            195 => 
            array (
                'id' => 203,
                'name' => 'Agence AIN EL KEBIRA',
                'code' => 702,
                'dre_id' => 18,
            ),
            196 => 
            array (
                'id' => 204,
                'name' => 'Agence SETIF MAABOUDA',
                'code' => 703,
                'dre_id' => 18,
            ),
            197 => 
            array (
                'id' => 205,
                'name' => 'Agence M\'SILA',
                'code' => 901,
                'dre_id' => 18,
            ),
            198 => 
            array (
                'id' => 206,
                'name' => 'AP SETIF',
                'code' => 704,
                'dre_id' => 18,
            ),
            199 => 
            array (
                'id' => 207,
                'name' => 'Agence BORDJ BOU ARRERIDJ',
                'code' => 705,
                'dre_id' => 18,
            ),
            200 => 
            array (
                'id' => 208,
                'name' => 'Agence EL EULMA',
                'code' => 706,
                'dre_id' => 18,
            ),
            201 => 
            array (
                'id' => 209,
                'name' => 'Agence AIN EL MELH',
                'code' => 707,
                'dre_id' => 18,
            ),
            202 => 
            array (
                'id' => 210,
                'name' => 'Agence SIDI AISSA',
                'code' => 708,
                'dre_id' => 18,
            ),
            203 => 
            array (
                'id' => 211,
                'name' => 'Agence SETIF',
                'code' => 711,
                'dre_id' => 18,
            ),
            204 => 
            array (
                'id' => 212,
                'name' => 'Agence Park Mall',
                'code' => 712,
                'dre_id' => 18,
            ),
            205 => 
            array (
                'id' => 213,
                'name' => 'AP TIARET "A"',
                'code' => 540,
                'dre_id' => 19,
            ),
            206 => 
            array (
                'id' => 214,
                'name' => 'Agence TIARET',
                'code' => 545,
                'dre_id' => 19,
            ),
            207 => 
            array (
                'id' => 215,
                'name' => 'Agence SIG',
                'code' => 546,
                'dre_id' => 19,
            ),
            208 => 
            array (
                'id' => 216,
                'name' => 'Agence SNVI TIARET',
                'code' => 548,
                'dre_id' => 19,
            ),
            209 => 
            array (
                'id' => 218,
                'name' => 'Agence MOHAMMADIA 2',
                'code' => 921,
                'dre_id' => 19,
            ),
            210 => 
            array (
                'id' => 219,
                'name' => 'Agence MOSTAGANEM "C"',
                'code' => 871,
                'dre_id' => 19,
            ),
            211 => 
            array (
                'id' => 220,
                'name' => 'AP MOSTAGANEM',
                'code' => 876,
                'dre_id' => 19,
            ),
            212 => 
            array (
                'id' => 221,
                'name' => 'Agence TIGHENIF',
                'code' => 877,
                'dre_id' => 19,
            ),
            213 => 
            array (
                'id' => 222,
                'name' => 'Agence MOSTAGANEM',
                'code' => 878,
                'dre_id' => 19,
            ),
            214 => 
            array (
                'id' => 223,
                'name' => 'Agence RELIZANE',
                'code' => 869,
                'dre_id' => 19,
            ),
            215 => 
            array (
                'id' => 224,
                'name' => 'Agence SAIDA',
                'code' => 724,
                'dre_id' => 20,
            ),
            216 => 
            array (
                'id' => 225,
                'name' => 'Agence El Bayadh',
                'code' => 726,
                'dre_id' => 20,
            ),
            217 => 
            array (
                'id' => 226,
                'name' => 'Agence Ain Temouchent',
                'code' => 728,
                'dre_id' => 20,
            ),
            218 => 
            array (
                'id' => 227,
                'name' => 'Agence EL MALLAH',
                'code' => 771,
                'dre_id' => 20,
            ),
            219 => 
            array (
                'id' => 228,
                'name' => 'AP SIDI BEL ABBES',
                'code' => 773,
                'dre_id' => 20,
            ),
            220 => 
            array (
                'id' => 229,
                'name' => 'Agence SIDI BEL ABBES',
                'code' => 774,
                'dre_id' => 20,
            ),
            221 => 
            array (
                'id' => 230,
                'name' => 'Agence MASCARA',
                'code' => 920,
                'dre_id' => 20,
            ),
        ));
        
        
    }
}