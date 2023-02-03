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
                'code' => '709',
                'dre_id' => 1,
                'id' => 1,
                'name' => 'Agence TOLGA',
            ),
            1 => 
            array (
                'code' => '386',
                'dre_id' => 1,
                'id' => 2,
                'name' => 'Agence BISKRA "A"',
            ),
            2 => 
            array (
                'code' => '387',
                'dre_id' => 1,
                'id' => 3,
                'name' => 'Agence BISKRA "C"',
            ),
            3 => 
            array (
                'code' => '335',
                'dre_id' => 1,
                'id' => 4,
                'name' => '-AP BATNA "A"',
            ),
            4 => 
            array (
                'code' => '336',
                'dre_id' => 1,
                'id' => 5,
                'name' => 'Agence BATNA',
            ),
            5 => 
            array (
                'code' => '340',
                'dre_id' => 1,
                'id' => 6,
                'name' => 'Agence BARIKA',
            ),
            6 => 
            array (
                'code' => '710',
                'dre_id' => 1,
                'id' => 7,
                'name' => 'Agence EL OUED',
            ),
            7 => 
            array (
                'code' => '713',
                'dre_id' => 1,
                'id' => 8,
                'name' => 'Agence Zeribet El Oued',
            ),
            8 => 
            array (
                'code' => '250',
                'dre_id' => 2,
                'id' => 9,
                'name' => 'Agence ADRAR',
            ),
            9 => 
            array (
                'code' => '251',
                'dre_id' => 2,
                'id' => 10,
                'name' => 'Agence TMIMOUN',
            ),
            10 => 
            array (
                'code' => '410',
                'dre_id' => 2,
                'id' => 11,
                'name' => 'Agence BENI OUNIF',
            ),
            11 => 
            array (
                'code' => '411',
                'dre_id' => 2,
                'id' => 12,
                'name' => 'Agence TINDOUF',
            ),
            12 => 
            array (
                'code' => '412',
                'dre_id' => 2,
                'id' => 13,
                'name' => 'AP BECHAR',
            ),
            13 => 
            array (
                'code' => '413',
                'dre_id' => 2,
                'id' => 14,
                'name' => 'Agence AOULEF',
            ),
            14 => 
            array (
                'code' => '414',
                'dre_id' => 2,
                'id' => 15,
                'name' => 'Agence DEBDABA',
            ),
            15 => 
            array (
                'code' => '415',
                'dre_id' => 2,
                'id' => 16,
                'name' => 'Agence BECHAR',
            ),
            16 => 
            array (
                'code' => '512',
                'dre_id' => 3,
                'id' => 17,
                'name' => 'AP TLEMCEN',
            ),
            17 => 
            array (
                'code' => '514',
                'dre_id' => 3,
                'id' => 18,
                'name' => 'Agence MAGHNIA',
            ),
            18 => 
            array (
                'code' => '526',
                'dre_id' => 3,
                'id' => 19,
                'name' => 'AP ABOU TACHFINE',
            ),
            19 => 
            array (
                'code' => '525',
                'dre_id' => 3,
                'id' => 20,
                'name' => 'Agence BENI SAF',
            ),
            20 => 
            array (
                'code' => '529',
                'dre_id' => 3,
                'id' => 21,
                'name' => 'Agence NEDROMA',
            ),
            21 => 
            array (
                'code' => '531',
                'dre_id' => 3,
                'id' => 22,
                'name' => 'Agence HENNAYA',
            ),
            22 => 
            array (
                'code' => '533',
                'dre_id' => 3,
                'id' => 23,
                'name' => 'Agence KIFANE',
            ),
            23 => 
            array (
                'code' => '527',
                'dre_id' => 3,
                'id' => 25,
                'name' => 'AP TLEMCEN 2',
            ),
            24 => 
            array (
                'code' => '528',
                'dre_id' => 3,
                'id' => 26,
                'name' => 'Agence SEBDOU',
            ),
            25 => 
            array (
                'code' => '530',
                'dre_id' => 3,
                'id' => 27,
                'name' => 'Agence REMCHI',
            ),
            26 => 
            array (
                'code' => '532',
                'dre_id' => 3,
                'id' => 28,
                'name' => 'Agence GHAZAOUAT',
            ),
            27 => 
            array (
                'code' => '725',
                'dre_id' => 3,
                'id' => 29,
                'name' => 'Agence MECHERIA',
            ),
            28 => 
            array (
                'code' => '727',
                'dre_id' => 3,
                'id' => 30,
                'name' => 'Agence Am Sefra',
            ),
            29 => 
            array (
                'code' => '730',
                'dre_id' => 3,
                'id' => 31,
                'name' => 'Agence NAAMA',
            ),
            30 => 
            array (
                'code' => '900',
                'dre_id' => 4,
                'id' => 32,
                'name' => 'Agence HAI ESSALEM',
            ),
            31 => 
            array (
                'code' => '951',
                'dre_id' => 4,
                'id' => 33,
                'name' => 'AP ORAN SOUMMAM',
            ),
            32 => 
            array (
                'code' => '952',
                'dre_id' => 4,
                'id' => 34,
                'name' => 'Agence ORAN "Boulanger"',
            ),
            33 => 
            array (
                'code' => '953',
                'dre_id' => 4,
                'id' => 35,
                'name' => 'Agence ORAN BEN M\'HIDI',
            ),
            34 => 
            array (
                'code' => '954',
                'dre_id' => 4,
                'id' => 36,
                'name' => 'Agence ARZEW',
            ),
            35 => 
            array (
                'code' => '955',
                'dre_id' => 4,
                'id' => 37,
                'name' => 'Agence MISSERGHIN',
            ),
            36 => 
            array (
                'code' => '957',
                'dre_id' => 4,
                'id' => 38,
                'name' => 'Agence ST EUGENE',
            ),
            37 => 
            array (
                'code' => '958',
                'dre_id' => 4,
                'id' => 39,
                'name' => 'Agence PLATEAU',
            ),
            38 => 
            array (
                'code' => '960',
                'dre_id' => 4,
                'id' => 40,
                'name' => 'AP ORAN Djillali',
            ),
            39 => 
            array (
                'code' => '962',
                'dre_id' => 4,
                'id' => 41,
                'name' => 'Agence AEROPORT',
            ),
            40 => 
            array (
                'code' => '963',
                'dre_id' => 4,
                'id' => 42,
                'name' => 'Agence OUEO TIELAT',
            ),
            41 => 
            array (
                'code' => '965',
                'dre_id' => 4,
                'id' => 43,
                'name' => 'Agence ES-SENIA Ville',
            ),
            42 => 
            array (
                'code' => '966',
                'dre_id' => 4,
                'id' => 44,
                'name' => 'AP ORAN sidi el houari',
            ),
            43 => 
            array (
                'code' => '967',
                'dre_id' => 4,
                'id' => 45,
                'name' => 'Agence AÎN EL TURCK',
            ),
            44 => 
            array (
                'code' => '969',
                'dre_id' => 4,
                'id' => 46,
                'name' => 'Agence Renault O/Tlelat',
            ),
            45 => 
            array (
                'code' => '460',
                'dre_id' => 5,
                'id' => 47,
                'name' => 'Agence BOUIRA',
            ),
            46 => 
            array (
                'code' => '462',
                'dre_id' => 5,
                'id' => 48,
                'name' => 'Agence AZAZGA',
            ),
            47 => 
            array (
                'code' => '576',
                'dre_id' => 5,
                'id' => 49,
                'name' => 'Agence LAKHDARIA',
            ),
            48 => 
            array (
                'code' => '577',
                'dre_id' => 5,
                'id' => 50,
                'name' => 'Agence BOGHNI',
            ),
            49 => 
            array (
                'code' => '578',
                'dre_id' => 5,
                'id' => 51,
                'name' => 'Agence Larbâa Nathlrathen',
            ),
            50 => 
            array (
                'code' => '643',
                'dre_id' => 5,
                'id' => 52,
                'name' => 'Agence BORDJ MENAIEL',
            ),
            51 => 
            array (
                'code' => '581',
                'dre_id' => 5,
                'id' => 53,
                'name' => 'AP TIZI OUZOU',
            ),
            52 => 
            array (
                'code' => '582',
                'dre_id' => 5,
                'id' => 54,
                'name' => 'Agence LES OUAOHIAS',
            ),
            53 => 
            array (
                'code' => '583',
                'dre_id' => 5,
                'id' => 56,
                'name' => 'AP TIZI OUZOU 2',
            ),
            54 => 
            array (
                'code' => '584',
                'dre_id' => 5,
                'id' => 57,
                'name' => 'Agence DRAA BEN KHEDDA',
            ),
            55 => 
            array (
                'code' => '642',
                'dre_id' => 5,
                'id' => 58,
                'name' => 'Agence DELLYS',
            ),
            56 => 
            array (
                'code' => '580',
                'dre_id' => 5,
                'id' => 59,
                'name' => 'Agonce TIZI OUZOU',
            ),
            57 => 
            array (
                'code' => '291',
                'dre_id' => 6,
                'id' => 60,
                'name' => 'Agence GHARDAIA',
            ),
            58 => 
            array (
                'code' => '292',
                'dre_id' => 6,
                'id' => 62,
                'name' => 'Agence GHARDAÏA 2',
            ),
            59 => 
            array (
                'code' => '294',
                'dre_id' => 6,
                'id' => 63,
                'name' => 'Agence BERRIANE',
            ),
            60 => 
            array (
                'code' => '295',
                'dre_id' => 6,
                'id' => 64,
                'name' => 'Agence GUERRARA',
            ),
            61 => 
            array (
                'code' => '296',
                'dre_id' => 6,
                'id' => 65,
                'name' => 'Agence METLILI CHAAMBA',
            ),
            62 => 
            array (
                'code' => '297',
                'dre_id' => 6,
                'id' => 66,
                'name' => 'Agence AFLOU',
            ),
            63 => 
            array (
                'code' => '301',
                'dre_id' => 6,
                'id' => 67,
                'name' => 'AP LAGHOUAT',
            ),
            64 => 
            array (
                'code' => '473',
                'dre_id' => 6,
                'id' => 68,
                'name' => 'Agence TAMANRASSET',
            ),
            65 => 
            array (
                'code' => '941',
                'dre_id' => 6,
                'id' => 69,
                'name' => 'Agence TOUGGOURT',
            ),
            66 => 
            array (
                'code' => '943',
                'dre_id' => 6,
                'id' => 70,
                'name' => 'Agence OUARGLA "B"',
            ),
            67 => 
            array (
                'code' => '944',
                'dre_id' => 6,
                'id' => 71,
                'name' => 'Agence OUARGLA',
            ),
            68 => 
            array (
                'code' => '945',
                'dre_id' => 6,
                'id' => 72,
                'name' => 'Agence DJANET',
            ),
            69 => 
            array (
                'code' => '946',
                'dre_id' => 6,
                'id' => 73,
                'name' => 'AP OUARGLA',
            ),
            70 => 
            array (
                'code' => '947',
                'dre_id' => 6,
                'id' => 74,
                'name' => 'Agence HASSI MESSAOUD',
            ),
            71 => 
            array (
                'code' => '948',
                'dre_id' => 6,
                'id' => 75,
                'name' => 'Agence Illizi',
            ),
            72 => 
            array (
                'code' => '832',
                'dre_id' => 7,
                'id' => 76,
                'name' => 'Agence CONSTANTINE PYRAMIDE',
            ),
            73 => 
            array (
                'code' => '833',
                'dre_id' => 7,
                'id' => 77,
                'name' => 'Agence TADJE-NANET',
            ),
            74 => 
            array (
                'code' => '835',
                'dre_id' => 7,
                'id' => 78,
                'name' => 'Agence EL KHROUB',
            ),
            75 => 
            array (
                'code' => '840',
                'dre_id' => 7,
                'id' => 79,
                'name' => 'AP AIN SMARA',
            ),
            76 => 
            array (
                'code' => '841',
                'dre_id' => 7,
                'id' => 80,
                'name' => 'Agence EL MILIA',
            ),
            77 => 
            array (
                'code' => '843',
                'dre_id' => 7,
                'id' => 81,
                'name' => 'Agence Chelghoum El Aïd',
            ),
            78 => 
            array (
                'code' => '844',
                'dre_id' => 7,
                'id' => 82,
                'name' => 'Agence DAKSI "C"',
            ),
            79 => 
            array (
                'code' => '845',
                'dre_id' => 7,
                'id' => 83,
                'name' => 'AP CONSTANTINE ',
            ),
            80 => 
            array (
                'code' => '846',
                'dre_id' => 7,
                'id' => 84,
                'name' => 'Agence MILA',
            ),
            81 => 
            array (
                'code' => '848',
                'dre_id' => 7,
                'id' => 85,
                'name' => 'Agence HAMMA BOUZIANE',
            ),
            82 => 
            array (
                'code' => '850',
                'dre_id' => 7,
                'id' => 86,
                'name' => 'AP FILLALI',
            ),
            83 => 
            array (
                'code' => '834',
                'dre_id' => 7,
                'id' => 87,
                'name' => 'Agence AIN EL BEY',
            ),
            84 => 
            array (
                'code' => '482',
                'dre_id' => 8,
                'id' => 88,
                'name' => 'Agence ANNABA',
            ),
            85 => 
            array (
                'code' => '485',
                'dre_id' => 8,
                'id' => 89,
                'name' => 'Agence AZZABA',
            ),
            86 => 
            array (
                'code' => '487',
                'dre_id' => 8,
                'id' => 90,
                'name' => 'Agence COLLO',
            ),
            87 => 
            array (
                'code' => '489',
                'dre_id' => 8,
                'id' => 91,
                'name' => 'Agence EL TARF',
            ),
            88 => 
            array (
                'code' => '488',
                'dre_id' => 8,
                'id' => 92,
                'name' => 'Agence OUED ZEN ATI',
            ),
            89 => 
            array (
                'code' => '743',
                'dre_id' => 8,
                'id' => 93,
                'name' => 'AP SKIKDA',
            ),
            90 => 
            array (
                'code' => '744',
                'dre_id' => 8,
                'id' => 94,
                'name' => 'Agence SKIKDA',
            ),
            91 => 
            array (
                'code' => '810',
                'dre_id' => 8,
                'id' => 95,
                'name' => 'AP ANNABA',
            ),
            92 => 
            array (
                'code' => '811',
                'dre_id' => 8,
                'id' => 97,
                'name' => 'AP ANNABA 2',
            ),
            93 => 
            array (
                'code' => '812',
                'dre_id' => 8,
                'id' => 98,
                'name' => 'Agence EL KALA',
            ),
            94 => 
            array (
                'code' => '813',
                'dre_id' => 8,
                'id' => 99,
                'name' => 'Agence ANNABA "B"',
            ),
            95 => 
            array (
                'code' => '814',
                'dre_id' => 8,
                'id' => 100,
                'name' => 'Agence SOUK AHRAS',
            ),
            96 => 
            array (
                'code' => '815',
                'dre_id' => 8,
                'id' => 101,
                'name' => 'Agence EL BOUNI',
            ),
            97 => 
            array (
                'code' => '816',
                'dre_id' => 8,
                'id' => 102,
                'name' => 'Agence GUELMA',
            ),
            98 => 
            array (
                'code' => '612',
                'dre_id' => 9,
                'id' => 103,
                'name' => 'Agence DAR EL BEIDA',
            ),
            99 => 
            array (
                'code' => '613',
                'dre_id' => 9,
                'id' => 104,
                'name' => 'Agence Aéroport HB',
            ),
            100 => 
            array (
                'code' => '616',
                'dre_id' => 9,
                'id' => 105,
                'name' => 'AP EL HARRACH',
            ),
            101 => 
            array (
                'code' => '619',
                'dre_id' => 9,
                'id' => 106,
                'name' => 'Agence EL HARRACH',
            ),
            102 => 
            array (
                'code' => '624',
                'dre_id' => 9,
                'id' => 107,
                'name' => 'Agence PINS MARITIMES',
            ),
            103 => 
            array (
                'code' => '625',
                'dre_id' => 9,
                'id' => 108,
                'name' => 'Agence KOUBA',
            ),
            104 => 
            array (
                'code' => '634',
                'dre_id' => 9,
                'id' => 109,
                'name' => 'AP OUED SMAR',
            ),
            105 => 
            array (
                'code' => '636',
                'dre_id' => 9,
                'id' => 110,
                'name' => 'Agence BARAKI',
            ),
            106 => 
            array (
                'code' => '637',
                'dre_id' => 9,
                'id' => 111,
                'name' => 'Agence GUE DE CONSTANTINE',
            ),
            107 => 
            array (
                'code' => '647',
                'dre_id' => 9,
                'id' => 112,
                'name' => 'AP EL HAMIZ',
            ),
            108 => 
            array (
                'code' => '648',
                'dre_id' => 9,
                'id' => 113,
                'name' => 'Agence MOHAMMADIA',
            ),
            109 => 
            array (
                'code' => '633',
                'dre_id' => 9,
                'id' => 114,
                'name' => 'AP BIRKHADEM',
            ),
            110 => 
            array (
                'code' => '638',
                'dre_id' => 9,
                'id' => 115,
                'name' => 'Agence Birkhadem',
            ),
            111 => 
            array (
                'code' => '427',
                'dre_id' => 10,
                'id' => 116,
                'name' => 'Agence CHERCHELL',
            ),
            112 => 
            array (
                'code' => '428',
                'dre_id' => 10,
                'id' => 117,
                'name' => 'Agence ZERALDA',
            ),
            113 => 
            array (
                'code' => '436',
                'dre_id' => 10,
                'id' => 118,
                'name' => 'Agence BABA HACENE',
            ),
            114 => 
            array (
                'code' => '438',
                'dre_id' => 10,
                'id' => 119,
                'name' => 'Agence TIPAZA',
            ),
            115 => 
            array (
                'code' => '439',
                'dre_id' => 10,
                'id' => 120,
                'name' => 'Agence HADJOUT',
            ),
            116 => 
            array (
                'code' => '440',
                'dre_id' => 10,
                'id' => 121,
                'name' => 'Agence STAOUELI',
            ),
            117 => 
            array (
                'code' => '441',
                'dre_id' => 10,
                'id' => 122,
                'name' => 'AP KOLEA',
            ),
            118 => 
            array (
                'code' => '444',
                'dre_id' => 10,
                'id' => 123,
                'name' => 'Agence BOU ISMAIL',
            ),
            119 => 
            array (
                'code' => '630',
                'dre_id' => 10,
                'id' => 124,
                'name' => 'Agence AÏN BENIAN',
            ),
            120 => 
            array (
                'code' => '430',
                'dre_id' => 11,
                'id' => 125,
                'name' => 'AP BOUFARIK',
            ),
            121 => 
            array (
                'code' => '431',
                'dre_id' => 11,
                'id' => 126,
                'name' => 'Agence Blida',
            ),
            122 => 
            array (
                'code' => '437',
                'dre_id' => 11,
                'id' => 127,
                'name' => 'Agence EL AFFROUN',
            ),
            123 => 
            array (
                'code' => '442',
                'dre_id' => 11,
                'id' => 128,
                'name' => 'AP BLIDA',
            ),
            124 => 
            array (
                'code' => '445',
                'dre_id' => 11,
                'id' => 129,
                'name' => 'Agence LES BANANIERS',
            ),
            125 => 
            array (
                'code' => '653',
                'dre_id' => 11,
                'id' => 130,
                'name' => 'Agence AIN OUSSERA',
            ),
            126 => 
            array (
                'code' => '654',
                'dre_id' => 11,
                'id' => 131,
                'name' => 'AP DJELFA',
            ),
            127 => 
            array (
                'code' => '849',
                'dre_id' => 11,
                'id' => 132,
                'name' => 'Agence BERROUAGHIA',
            ),
            128 => 
            array (
                'code' => '851',
                'dre_id' => 11,
                'id' => 133,
                'name' => 'AP MEDEA',
            ),
            129 => 
            array (
                'code' => '858',
                'dre_id' => 11,
                'id' => 134,
                'name' => 'Agence KSAR EL BOUKHARI',
            ),
            130 => 
            array (
                'code' => '632',
                'dre_id' => 12,
                'id' => 135,
                'name' => 'AP ROUIBA',
            ),
            131 => 
            array (
                'code' => '640',
                'dre_id' => 12,
                'id' => 136,
                'name' => 'AP BORDJ EL KIFFAN',
            ),
            132 => 
            array (
                'code' => '631',
                'dre_id' => 12,
                'id' => 137,
                'name' => 'Agence THENIA',
            ),
            133 => 
            array (
                'code' => '641',
                'dre_id' => 12,
                'id' => 139,
                'name' => 'AP ROUIBA 2',
            ),
            134 => 
            array (
                'code' => '173',
                'dre_id' => 12,
                'id' => 140,
                'name' => 'CCD',
            ),
            135 => 
            array (
                'code' => '644',
                'dre_id' => 12,
                'id' => 141,
                'name' => 'Agence REGHAIA"1"',
            ),
            136 => 
            array (
                'code' => '645',
                'dre_id' => 12,
                'id' => 142,
                'name' => 'Agence BOUMERDES',
            ),
            137 => 
            array (
                'code' => '646',
                'dre_id' => 12,
                'id' => 143,
                'name' => 'Agence AIN TAYA',
            ),
            138 => 
            array (
                'code' => '649',
                'dre_id' => 12,
                'id' => 144,
                'name' => 'Agence EL HAMIZ',
            ),
            139 => 
            array (
                'code' => '650',
                'dre_id' => 12,
                'id' => 145,
                'name' => 'Agence REGHAIA “II"',
            ),
            140 => 
            array (
                'code' => '651',
                'dre_id' => 12,
                'id' => 146,
                'name' => 'Agence BORDJ EL BAHRI',
            ),
            141 => 
            array (
                'code' => '356',
                'dre_id' => 13,
                'id' => 147,
                'name' => 'AP BEJAIA',
            ),
            142 => 
            array (
                'code' => '585',
                'dre_id' => 13,
                'id' => 148,
                'name' => 'Agence EL KSEUR',
            ),
            143 => 
            array (
                'code' => '586',
                'dre_id' => 13,
                'id' => 149,
                'name' => 'Agence TAZMALT',
            ),
            144 => 
            array (
                'code' => '589',
                'dre_id' => 13,
                'id' => 150,
                'name' => 'Agence S.EL TENINE AOKAS',
            ),
            145 => 
            array (
                'code' => '587',
                'dre_id' => 13,
                'id' => 151,
                'name' => 'Agence IHADDADEN',
            ),
            146 => 
            array (
                'code' => '588',
                'dre_id' => 13,
                'id' => 152,
                'name' => 'Agence BEJAIA',
            ),
            147 => 
            array (
                'code' => '671',
                'dre_id' => 13,
                'id' => 153,
                'name' => 'Agence JIJEL',
            ),
            148 => 
            array (
                'code' => '',
                'dre_id' => 13,
                'id' => 154,
                'name' => 'Bureau de change Soummam',
            ),
            149 => 
            array (
                'code' => '590',
                'dre_id' => 13,
                'id' => 155,
                'name' => 'Agence AKBOU',
            ),
            150 => 
            array (
                'code' => '315',
                'dre_id' => 14,
                'id' => 156,
                'name' => 'Agence KHENCHELA',
            ),
            151 => 
            array (
                'code' => '316',
                'dre_id' => 14,
                'id' => 157,
                'name' => 'Agence OUM EL BOUAGUI',
            ),
            152 => 
            array (
                'code' => '321',
                'dre_id' => 14,
                'id' => 158,
                'name' => 'Agence AIN BEIDA',
            ),
            153 => 
            array (
                'code' => '323',
                'dre_id' => 14,
                'id' => 160,
                'name' => 'Agence KHENCHELA 2',
            ),
            154 => 
            array (
                'code' => '325',
                'dre_id' => 14,
                'id' => 161,
                'name' => 'Agence AIN MLILA',
            ),
            155 => 
            array (
                'code' => '491',
                'dre_id' => 14,
                'id' => 162,
                'name' => 'AP TEBESSA',
            ),
            156 => 
            array (
                'code' => '483',
                'dre_id' => 14,
                'id' => 163,
                'name' => 'Agence TEBESSA',
            ),
            157 => 
            array (
                'code' => '484',
                'dre_id' => 14,
                'id' => 164,
                'name' => 'Agence OUENZA',
            ),
            158 => 
            array (
                'code' => '486',
                'dre_id' => 14,
                'id' => 165,
                'name' => 'Agence BIR ELATER',
            ),
            159 => 
            array (
                'code' => '800',
                'dre_id' => 14,
                'id' => 167,
                'name' => 'Agence Ain Beida 2',
            ),
            160 => 
            array (
                'code' => '842',
                'dre_id' => 14,
                'id' => 168,
                'name' => 'Agence OUM EL BOUAGHI',
            ),
            161 => 
            array (
                'code' => '599',
                'dre_id' => 15,
                'id' => 169,
                'name' => 'AP CHE GUEVARA',
            ),
            162 => 
            array (
                'code' => '602',
                'dre_id' => 15,
                'id' => 170,
                'name' => 'AP TELEMLY',
            ),
            163 => 
            array (
                'code' => '605',
                'dre_id' => 15,
                'id' => 171,
                'name' => 'AP LIBERTE',
            ),
            164 => 
            array (
                'code' => '629',
                'dre_id' => 15,
                'id' => 172,
                'name' => 'Agenoe BAB EL OUED',
            ),
            165 => 
            array (
                'code' => '162',
                'dre_id' => 15,
                'id' => 173,
                'name' => 'Caisse Centrale CHE "CCD"',
            ),
            166 => 
            array (
                'code' => '620',
                'dre_id' => 15,
                'id' => 174,
                'name' => 'AP ZIROUT YOUCEF',
            ),
            167 => 
            array (
                'code' => '627',
                'dre_id' => 15,
                'id' => 175,
                'name' => 'AP BOUZAREAH',
            ),
            168 => 
            array (
                'code' => '628',
                'dre_id' => 15,
                'id' => 176,
                'name' => 'Agence PORT-SAÏD',
            ),
            169 => 
            array (
                'code' => '608',
                'dre_id' => 15,
                'id' => 177,
                'name' => 'Agence BOLOGHINE',
            ),
            170 => 
            array (
                'code' => '601',
                'dre_id' => 16,
                'id' => 178,
                'name' => 'AP Didooche Mourad',
            ),
            171 => 
            array (
                'code' => '603',
                'dre_id' => 16,
                'id' => 179,
                'name' => 'Agence Hydra',
            ),
            172 => 
            array (
                'code' => '607',
                'dre_id' => 16,
                'id' => 180,
                'name' => 'Agence Hamani "B"',
            ),
            173 => 
            array (
                'code' => '609',
                'dre_id' => 16,
                'id' => 181,
                'name' => 'Agence "D"',
            ),
            174 => 
            array (
                'code' => '610',
                'dre_id' => 16,
                'id' => 182,
                'name' => 'AP Les Halles',
            ),
            175 => 
            array (
                'code' => '611',
                'dre_id' => 16,
                'id' => 183,
                'name' => 'AP Hussein Dey',
            ),
            176 => 
            array (
                'code' => '635',
                'dre_id' => 16,
                'id' => 184,
                'name' => 'Agence Hussein Dey',
            ),
            177 => 
            array (
                'code' => '614',
                'dre_id' => 16,
                'id' => 185,
                'name' => 'Agence "N"',
            ),
            178 => 
            array (
                'code' => '615',
                'dre_id' => 16,
                'id' => 186,
                'name' => 'Agence BELAHDJEL',
            ),
            179 => 
            array (
                'code' => '617',
                'dre_id' => 16,
                'id' => 187,
                'name' => 'Agence RIADH EL FETH',
            ),
            180 => 
            array (
                'code' => '621',
                'dre_id' => 16,
                'id' => 188,
                'name' => 'AP EL BIAR',
            ),
            181 => 
            array (
                'code' => '622',
                'dre_id' => 16,
                'id' => 189,
                'name' => 'Agence El Quods',
            ),
            182 => 
            array (
                'code' => '623',
                'dre_id' => 16,
                'id' => 190,
                'name' => 'AP Ben M\'hidi',
            ),
            183 => 
            array (
                'code' => '626',
                'dre_id' => 16,
                'id' => 191,
                'name' => 'AP AGHA',
            ),
            184 => 
            array (
                'code' => '260',
                'dre_id' => 17,
                'id' => 192,
                'name' => 'Agence CHLEF',
            ),
            185 => 
            array (
                'code' => '262',
                'dre_id' => 17,
                'id' => 193,
                'name' => 'Agence MILIANA',
            ),
            186 => 
            array (
                'code' => '268',
                'dre_id' => 17,
                'id' => 194,
                'name' => 'AP AIN DEFLA',
            ),
            187 => 
            array (
                'code' => '272',
                'dre_id' => 17,
                'id' => 195,
                'name' => 'Agence EL ATTAF',
            ),
            188 => 
            array (
                'code' => '275',
                'dre_id' => 17,
                'id' => 196,
                'name' => 'AP CHLEF',
            ),
            189 => 
            array (
                'code' => '276',
                'dre_id' => 17,
                'id' => 197,
                'name' => 'Agence OUED RHIOU',
            ),
            190 => 
            array (
                'code' => '277',
                'dre_id' => 17,
                'id' => 198,
                'name' => 'Agence TISSEMSILT',
            ),
            191 => 
            array (
                'code' => '278',
                'dre_id' => 17,
                'id' => 199,
                'name' => 'Agence KHEMIS MILIANA',
            ),
            192 => 
            array (
                'code' => '279',
                'dre_id' => 17,
                'id' => 200,
                'name' => 'Agence TENES',
            ),
            193 => 
            array (
                'code' => '338',
                'dre_id' => 18,
                'id' => 201,
                'name' => 'Agence Amoucha',
            ),
            194 => 
            array (
                'code' => '701',
                'dre_id' => 18,
                'id' => 202,
                'name' => 'Agence BOUSSAADA',
            ),
            195 => 
            array (
                'code' => '702',
                'dre_id' => 18,
                'id' => 203,
                'name' => 'Agence AIN EL KEBIRA',
            ),
            196 => 
            array (
                'code' => '703',
                'dre_id' => 18,
                'id' => 204,
                'name' => 'Agence SETIF MAABOUDA',
            ),
            197 => 
            array (
                'code' => '901',
                'dre_id' => 18,
                'id' => 205,
                'name' => 'Agence M\'SILA',
            ),
            198 => 
            array (
                'code' => '704',
                'dre_id' => 18,
                'id' => 206,
                'name' => 'AP SETIF',
            ),
            199 => 
            array (
                'code' => '705',
                'dre_id' => 18,
                'id' => 207,
                'name' => 'Agence BORDJ BOU ARRERIDJ',
            ),
            200 => 
            array (
                'code' => '706',
                'dre_id' => 18,
                'id' => 208,
                'name' => 'Agence EL EULMA',
            ),
            201 => 
            array (
                'code' => '707',
                'dre_id' => 18,
                'id' => 209,
                'name' => 'Agence AIN EL MELH',
            ),
            202 => 
            array (
                'code' => '708',
                'dre_id' => 18,
                'id' => 210,
                'name' => 'Agence SIDI AISSA',
            ),
            203 => 
            array (
                'code' => '711',
                'dre_id' => 18,
                'id' => 211,
                'name' => 'Agence SETIF',
            ),
            204 => 
            array (
                'code' => '712',
                'dre_id' => 18,
                'id' => 212,
                'name' => 'Agence Park Mall',
            ),
            205 => 
            array (
                'code' => '540',
                'dre_id' => 19,
                'id' => 213,
                'name' => 'AP TIARET "A"',
            ),
            206 => 
            array (
                'code' => '545',
                'dre_id' => 19,
                'id' => 214,
                'name' => 'Agence TIARET',
            ),
            207 => 
            array (
                'code' => '546',
                'dre_id' => 19,
                'id' => 215,
                'name' => 'Agence SIG',
            ),
            208 => 
            array (
                'code' => '548',
                'dre_id' => 19,
                'id' => 216,
                'name' => 'Agence SNVI TIARET',
            ),
            209 => 
            array (
                'code' => '921',
                'dre_id' => 19,
                'id' => 218,
                'name' => 'Agence MOHAMMADIA 2',
            ),
            210 => 
            array (
                'code' => '871',
                'dre_id' => 19,
                'id' => 219,
                'name' => 'Agence MOSTAGANEM "C"',
            ),
            211 => 
            array (
                'code' => '876',
                'dre_id' => 19,
                'id' => 220,
                'name' => 'AP MOSTAGANEM',
            ),
            212 => 
            array (
                'code' => '877',
                'dre_id' => 19,
                'id' => 221,
                'name' => 'Agence TIGHENIF',
            ),
            213 => 
            array (
                'code' => '878',
                'dre_id' => 19,
                'id' => 222,
                'name' => 'Agence MOSTAGANEM',
            ),
            214 => 
            array (
                'code' => '869',
                'dre_id' => 19,
                'id' => 223,
                'name' => 'Agence RELIZANE',
            ),
            215 => 
            array (
                'code' => '724',
                'dre_id' => 20,
                'id' => 224,
                'name' => 'Agence SAIDA',
            ),
            216 => 
            array (
                'code' => '726',
                'dre_id' => 20,
                'id' => 225,
                'name' => 'Agence El Bayadh',
            ),
            217 => 
            array (
                'code' => '728',
                'dre_id' => 20,
                'id' => 226,
                'name' => 'Agence Ain Temouchent',
            ),
            218 => 
            array (
                'code' => '771',
                'dre_id' => 20,
                'id' => 227,
                'name' => 'Agence EL MALLAH',
            ),
            219 => 
            array (
                'code' => '773',
                'dre_id' => 20,
                'id' => 228,
                'name' => 'AP SIDI BEL ABBES',
            ),
            220 => 
            array (
                'code' => '774',
                'dre_id' => 20,
                'id' => 229,
                'name' => 'Agence SIDI BEL ABBES',
            ),
            221 => 
            array (
                'code' => '920',
                'dre_id' => 20,
                'id' => 230,
                'name' => 'Agence MASCARA',
            ),
        ));
        
        
    }
}