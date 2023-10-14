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
                'id' => '1',
                'name' => 'Ag BISKRA',
                'code' => '386',
                'dre_id' => '1',
                'category_id' => '2',
            ),
            1 => 
            array (
                'id' => '2',
                'name' => 'Ag BISKRA',
                'code' => '387',
                'dre_id' => '1',
                'category_id' => '4',
            ),
            2 => 
            array (
                'id' => '3',
                'name' => 'Ag BATNA',
                'code' => '336',
                'dre_id' => '1',
                'category_id' => '4',
            ),
            3 => 
            array (
                'id' => '4',
                'name' => 'Ap BATNA',
                'code' => '335',
                'dre_id' => '1',
                'category_id' => '1',
            ),
            4 => 
            array (
                'id' => '5',
                'name' => 'Ag BARIKA',
                'code' => '340',
                'dre_id' => '1',
                'category_id' => '3',
            ),
            5 => 
            array (
                'id' => '6',
                'name' => 'Ag ELOUED',
                'code' => '710',
                'dre_id' => '1',
                'category_id' => '3',
            ),
            6 => 
            array (
                'id' => '7',
                'name' => 'Ag ZEO',
                'code' => '713',
                'dre_id' => '1',
                'category_id' => '4',
            ),
            7 => 
            array (
                'id' => '8',
                'name' => 'Ag TOLGA',
                'code' => '709',
                'dre_id' => '1',
                'category_id' => '4',
            ),
            8 => 
            array (
                'id' => '9',
                'name' => 'Béni ounif',
                'code' => '410',
                'dre_id' => '2',
                'category_id' => '3',
            ),
            9 => 
            array (
                'id' => '10',
                'name' => 'Tindouf',
                'code' => '411',
                'dre_id' => '2',
                'category_id' => '3',
            ),
            10 => 
            array (
                'id' => '11',
                'name' => 'AP. Béchar',
                'code' => '412',
                'dre_id' => '2',
                'category_id' => '1',
            ),
            11 => 
            array (
                'id' => '12',
                'name' => 'Aoulef',
                'code' => '413',
                'dre_id' => '2',
                'category_id' => '3',
            ),
            12 => 
            array (
                'id' => '13',
                'name' => 'Debdaba',
                'code' => '414',
                'dre_id' => '2',
                'category_id' => '3',
            ),
            13 => 
            array (
                'id' => '14',
                'name' => 'Béchar',
                'code' => '415',
                'dre_id' => '2',
                'category_id' => '4',
            ),
            14 => 
            array (
                'id' => '15',
                'name' => 'ADRAR',
                'code' => '250',
                'dre_id' => '2',
                'category_id' => '2',
            ),
            15 => 
            array (
                'id' => '16',
                'name' => 'Timimoun',
                'code' => '251',
                'dre_id' => '2',
                'category_id' => '3',
            ),
            16 => 
            array (
                'id' => '17',
                'name' => 'AP TLEMCEN',
                'code' => '512',
                'dre_id' => '3',
                'category_id' => '1',
            ),
            17 => 
            array (
                'id' => '18',
                'name' => 'AG MAGHNIA',
                'code' => '514',
                'dre_id' => '3',
                'category_id' => '3',
            ),
            18 => 
            array (
                'id' => '19',
                'name' => 'AG BENI SAF',
                'code' => '525',
                'dre_id' => '3',
                'category_id' => '4',
            ),
            19 => 
            array (
                'id' => '20',
                'name' => 'AP Abou tachfin',
                'code' => '526',
                'dre_id' => '3',
                'category_id' => '1',
            ),
            20 => 
            array (
                'id' => '21',
                'name' => 'AP tlemcen',
                'code' => '527',
                'dre_id' => '3',
                'category_id' => '1',
            ),
            21 => 
            array (
                'id' => '22',
                'name' => 'AG SEBDOU',
                'code' => '528',
                'dre_id' => '3',
                'category_id' => '3',
            ),
            22 => 
            array (
                'id' => '23',
                'name' => 'AG NEDROMA',
                'code' => '529',
                'dre_id' => '3',
                'category_id' => '4',
            ),
            23 => 
            array (
                'id' => '24',
                'name' => 'AG REMCHI',
                'code' => '530',
                'dre_id' => '3',
                'category_id' => '3',
            ),
            24 => 
            array (
                'id' => '25',
                'name' => 'AG  HENNAYA',
                'code' => '531',
                'dre_id' => '3',
                'category_id' => '4',
            ),
            25 => 
            array (
                'id' => '26',
                'name' => 'AG GHAZAOUAT',
                'code' => '532',
                'dre_id' => '3',
                'category_id' => '4',
            ),
            26 => 
            array (
                'id' => '27',
                'name' => 'AG KIFANE',
                'code' => '533',
                'dre_id' => '3',
                'category_id' => '4',
            ),
            27 => 
            array (
                'id' => '28',
                'name' => 'AG MECHERIA',
                'code' => '725',
                'dre_id' => '3',
                'category_id' => '3',
            ),
            28 => 
            array (
                'id' => '29',
                'name' => 'AG AIN SEFRA',
                'code' => '727',
                'dre_id' => '3',
                'category_id' => '3',
            ),
            29 => 
            array (
                'id' => '30',
                'name' => 'AG NAAMA',
                'code' => '730',
                'dre_id' => '3',
                'category_id' => '4',
            ),
            30 => 
            array (
                'id' => '31',
                'name' => 'AG HAI ESSALEM',
                'code' => '900',
                'dre_id' => '4',
                'category_id' => '4',
            ),
            31 => 
            array (
                'id' => '32',
                'name' => 'AP ORAN SOUMMAM',
                'code' => '951',
                'dre_id' => '4',
                'category_id' => '1',
            ),
            32 => 
            array (
                'id' => '33',
                'name' => 'AG ORAN BOULANGER',
                'code' => '952',
                'dre_id' => '4',
                'category_id' => '2',
            ),
            33 => 
            array (
                'id' => '34',
                'name' => 'AG ORAN BEN M\'HIDI',
                'code' => '953',
                'dre_id' => '4',
                'category_id' => '3',
            ),
            34 => 
            array (
                'id' => '35',
                'name' => 'AG ARZEW',
                'code' => '954',
                'dre_id' => '4',
                'category_id' => '2',
            ),
            35 => 
            array (
                'id' => '36',
                'name' => 'AG MISSERGHIN',
                'code' => '955',
                'dre_id' => '4',
                'category_id' => '4',
            ),
            36 => 
            array (
                'id' => '37',
                'name' => 'AG ST EUGENE',
                'code' => '957',
                'dre_id' => '4',
                'category_id' => '3',
            ),
            37 => 
            array (
                'id' => '38',
                'name' => 'AG PLATEAU',
                'code' => '958',
                'dre_id' => '4',
                'category_id' => '3',
            ),
            38 => 
            array (
                'id' => '39',
                'name' => 'AP ORAN DJILLALI',
                'code' => '960',
                'dre_id' => '4',
                'category_id' => '1',
            ),
            39 => 
            array (
                'id' => '40',
                'name' => 'AG AEROPORT',
                'code' => '962',
                'dre_id' => '4',
                'category_id' => '4',
            ),
            40 => 
            array (
                'id' => '41',
                'name' => 'AG OUED TLELAT',
                'code' => '963',
                'dre_id' => '4',
                'category_id' => '4',
            ),
            41 => 
            array (
                'id' => '42',
                'name' => 'AG ES-SENIA VILLE',
                'code' => '965',
                'dre_id' => '4',
                'category_id' => '3',
            ),
            42 => 
            array (
                'id' => '43',
                'name' => 'AP ORAN SIDI EL HOUARI',
                'code' => '966',
                'dre_id' => '4',
                'category_id' => '1',
            ),
            43 => 
            array (
                'id' => '44',
                'name' => 'AG AIN EL TURCK',
                'code' => '967',
                'dre_id' => '4',
                'category_id' => '4',
            ),
            44 => 
            array (
                'id' => '45',
                'name' => 'AG RENAULT',
                'code' => '969',
                'dre_id' => '4',
                'category_id' => '4',
            ),
            45 => 
            array (
                'id' => '46',
                'name' => 'AG TOSYALI',
                'code' => '970',
                'dre_id' => '4',
                'category_id' => '4',
            ),
            46 => 
            array (
                'id' => '47',
                'name' => 'AG BOUIRA',
                'code' => '460',
                'dre_id' => '5',
                'category_id' => '3',
            ),
            47 => 
            array (
                'id' => '48',
                'name' => 'AG AZAZGA',
                'code' => '462',
                'dre_id' => '5',
                'category_id' => '4',
            ),
            48 => 
            array (
                'id' => '49',
                'name' => 'AG LAKHDARIA',
                'code' => '576',
                'dre_id' => '5',
                'category_id' => '4',
            ),
            49 => 
            array (
                'id' => '50',
                'name' => 'AG BOGHNI',
                'code' => '577',
                'dre_id' => '5',
                'category_id' => '3',
            ),
            50 => 
            array (
                'id' => '51',
                'name' => 'AG L.N.I',
                'code' => '578',
                'dre_id' => '5',
                'category_id' => '4',
            ),
            51 => 
            array (
                'id' => '52',
                'name' => 'AG TIZI-OUZOU',
                'code' => '580',
                'dre_id' => '5',
                'category_id' => '4',
            ),
            52 => 
            array (
                'id' => '53',
                'name' => 'AP TIZI OUZOU',
                'code' => '581',
                'dre_id' => '5',
                'category_id' => '1',
            ),
            53 => 
            array (
                'id' => '54',
                'name' => 'AG Ouadhias',
                'code' => '582',
                'dre_id' => '5',
                'category_id' => '4',
            ),
            54 => 
            array (
                'id' => '55',
                'name' => 'AG N.Ville',
                'code' => '583',
                'dre_id' => '5',
                'category_id' => '3',
            ),
            55 => 
            array (
                'id' => '56',
                'name' => 'AG D.B.K',
                'code' => '584',
                'dre_id' => '5',
                'category_id' => '4',
            ),
            56 => 
            array (
                'id' => '57',
                'name' => 'AG Dellys',
                'code' => '642',
                'dre_id' => '5',
                'category_id' => '4',
            ),
            57 => 
            array (
                'id' => '58',
                'name' => 'AG B.Menaiel',
                'code' => '643',
                'dre_id' => '5',
                'category_id' => '3',
            ),
            58 => 
            array (
                'id' => '59',
                'name' => 'TAMANRASSET',
                'code' => '473',
                'dre_id' => '6',
                'category_id' => '2',
            ),
            59 => 
            array (
                'id' => '60',
                'name' => 'TOUGGOURT',
                'code' => '941',
                'dre_id' => '6',
                'category_id' => '2',
            ),
            60 => 
            array (
                'id' => '61',
                'name' => 'OUARGLA',
                'code' => '943',
                'dre_id' => '6',
                'category_id' => '4',
            ),
            61 => 
            array (
                'id' => '62',
                'name' => 'OUARGLA',
                'code' => '944',
                'dre_id' => '6',
                'category_id' => '4',
            ),
            62 => 
            array (
                'id' => '63',
                'name' => 'DJANET',
                'code' => '945',
                'dre_id' => '6',
                'category_id' => '3',
            ),
            63 => 
            array (
                'id' => '64',
                'name' => 'AP OUARGLA',
                'code' => '946',
                'dre_id' => '6',
                'category_id' => '1',
            ),
            64 => 
            array (
                'id' => '65',
                'name' => 'HASSI MESSAOUD',
                'code' => '947',
                'dre_id' => '6',
                'category_id' => '3',
            ),
            65 => 
            array (
                'id' => '66',
                'name' => 'ILLIZI',
                'code' => '948',
                'dre_id' => '6',
                'category_id' => '4',
            ),
            66 => 
            array (
                'id' => '67',
                'name' => 'AIN MLILA',
                'code' => '325',
                'dre_id' => '7',
                'category_id' => '4',
            ),
            67 => 
            array (
                'id' => '68',
                'name' => 'pyramide',
                'code' => '832',
                'dre_id' => '7',
                'category_id' => '2',
            ),
            68 => 
            array (
                'id' => '69',
                'name' => 'TADJENANET',
                'code' => '833',
                'dre_id' => '7',
                'category_id' => '4',
            ),
            69 => 
            array (
                'id' => '70',
                'name' => 'el khroub',
                'code' => '835',
                'dre_id' => '7',
                'category_id' => '3',
            ),
            70 => 
            array (
                'id' => '71',
                'name' => 'AIN SMARA',
                'code' => '840',
                'dre_id' => '7',
                'category_id' => '1',
            ),
            71 => 
            array (
                'id' => '72',
                'name' => 'EL MILIA',
                'code' => '841',
                'dre_id' => '7',
                'category_id' => '3',
            ),
            72 => 
            array (
                'id' => '73',
                'name' => 'CHELGHOUM EL AID',
                'code' => '843',
                'dre_id' => '7',
                'category_id' => '4',
            ),
            73 => 
            array (
                'id' => '74',
                'name' => 'DAKSI',
                'code' => '844',
                'dre_id' => '7',
                'category_id' => '4',
            ),
            74 => 
            array (
                'id' => '75',
                'name' => 'AP CONSTANTINE',
                'code' => '845',
                'dre_id' => '7',
                'category_id' => '1',
            ),
            75 => 
            array (
                'id' => '76',
                'name' => 'mila',
                'code' => '846',
                'dre_id' => '7',
                'category_id' => '3',
            ),
            76 => 
            array (
                'id' => '77',
                'name' => 'hamma bouziane',
                'code' => '848',
                'dre_id' => '7',
                'category_id' => '3',
            ),
            77 => 
            array (
                'id' => '78',
                'name' => 'FILLALI',
                'code' => '850',
                'dre_id' => '7',
                'category_id' => '3',
            ),
            78 => 
            array (
                'id' => '79',
                'name' => 'ain el bey',
                'code' => '834',
                'dre_id' => '7',
                'category_id' => '2',
            ),
            79 => 
            array (
                'id' => '80',
                'name' => 'Aeroport mohamed boudiaf',
                'code' => '829',
                'dre_id' => '7',
                'category_id' => '4',
            ),
            80 => 
            array (
                'id' => '81',
                'name' => 'AP ANNABA',
                'code' => '810',
                'dre_id' => '8',
                'category_id' => '1',
            ),
            81 => 
            array (
                'id' => '82',
                'name' => 'AP ANNABA',
                'code' => '811',
                'dre_id' => '8',
                'category_id' => '1',
            ),
            82 => 
            array (
                'id' => '83',
                'name' => 'AP SKIKDA',
                'code' => '743',
                'dre_id' => '8',
                'category_id' => '1',
            ),
            83 => 
            array (
                'id' => '84',
                'name' => 'AG GUELMA A',
                'code' => '816',
                'dre_id' => '8',
                'category_id' => '2',
            ),
            84 => 
            array (
                'id' => '85',
                'name' => 'AG COLLO',
                'code' => '487',
                'dre_id' => '8',
                'category_id' => '3',
            ),
            85 => 
            array (
                'id' => '86',
                'name' => 'AG ANNABA B',
                'code' => '813',
                'dre_id' => '8',
                'category_id' => '4',
            ),
            86 => 
            array (
                'id' => '87',
                'name' => 'AG OUED ZENATI C',
                'code' => '488',
                'dre_id' => '8',
                'category_id' => '4',
            ),
            87 => 
            array (
                'id' => '88',
                'name' => 'AG EL KALA C',
                'code' => '812',
                'dre_id' => '8',
                'category_id' => '4',
            ),
            88 => 
            array (
                'id' => '89',
                'name' => 'AG SOUK AHRAS C',
                'code' => '814',
                'dre_id' => '8',
                'category_id' => '4',
            ),
            89 => 
            array (
                'id' => '90',
                'name' => 'AG AZZABA C',
                'code' => '485',
                'dre_id' => '8',
                'category_id' => '4',
            ),
            90 => 
            array (
                'id' => '91',
                'name' => 'AG SKIKDA C',
                'code' => '744',
                'dre_id' => '8',
                'category_id' => '4',
            ),
            91 => 
            array (
                'id' => '92',
                'name' => 'AG EL BOUNI C',
                'code' => '815',
                'dre_id' => '8',
                'category_id' => '4',
            ),
            92 => 
            array (
                'id' => '93',
                'name' => 'AG ANNABA C',
                'code' => '482',
                'dre_id' => '8',
                'category_id' => '4',
            ),
            93 => 
            array (
                'id' => '94',
                'name' => 'AG EL TAREF C',
                'code' => '489',
                'dre_id' => '8',
                'category_id' => '4',
            ),
            94 => 
            array (
                'id' => '95',
                'name' => 'AEROPORT RABAH BITAT',
                'code' => '817',
                'dre_id' => '8',
                'category_id' => '4',
            ),
            95 => 
            array (
                'id' => '96',
                'name' => 'DAR EL BEIDA',
                'code' => '612',
                'dre_id' => '9',
                'category_id' => '2',
            ),
            96 => 
            array (
                'id' => '97',
                'name' => 'AGENCE AEROPPRT H/B',
                'code' => '613',
                'dre_id' => '9',
                'category_id' => '4',
            ),
            97 => 
            array (
                'id' => '98',
                'name' => 'AP EL HARRACH',
                'code' => '616',
                'dre_id' => '9',
                'category_id' => '1',
            ),
            98 => 
            array (
                'id' => '99',
                'name' => 'EL HARRACH',
                'code' => '619',
                'dre_id' => '9',
                'category_id' => '4',
            ),
            99 => 
            array (
                'id' => '100',
                'name' => 'PINS MARITIMES',
                'code' => '624',
                'dre_id' => '9',
                'category_id' => '2',
            ),
            100 => 
            array (
                'id' => '101',
                'name' => 'KOUBA',
                'code' => '625',
                'dre_id' => '9',
                'category_id' => '4',
            ),
            101 => 
            array (
                'id' => '102',
                'name' => 'AP BIRKHADEM',
                'code' => '633',
                'dre_id' => '9',
                'category_id' => '1',
            ),
            102 => 
            array (
                'id' => '103',
                'name' => 'AP OUED SMAR',
                'code' => '634',
                'dre_id' => '9',
                'category_id' => '1',
            ),
            103 => 
            array (
                'id' => '104',
                'name' => 'BARAKI',
                'code' => '636',
                'dre_id' => '9',
                'category_id' => '4',
            ),
            104 => 
            array (
                'id' => '105',
                'name' => 'GUE DE CONSTANTINE',
                'code' => '637',
                'dre_id' => '9',
                'category_id' => '4',
            ),
            105 => 
            array (
                'id' => '106',
                'name' => 'AGENCE BIRKHADEM',
                'code' => '638',
                'dre_id' => '9',
                'category_id' => '4',
            ),
            106 => 
            array (
                'id' => '107',
                'name' => 'AP EL HAMIZ',
                'code' => '647',
                'dre_id' => '9',
                'category_id' => '1',
            ),
            107 => 
            array (
                'id' => '108',
                'name' => 'MOHAMMADIA',
                'code' => '648',
                'dre_id' => '9',
                'category_id' => '4',
            ),
            108 => 
            array (
                'id' => '109',
                'name' => 'AIN BENIAN',
                'code' => '630',
                'dre_id' => '10',
                'category_id' => '2',
            ),
            109 => 
            array (
                'id' => '110',
                'name' => 'BABAHASSEN',
                'code' => '436',
                'dre_id' => '10',
                'category_id' => '4',
            ),
            110 => 
            array (
                'id' => '111',
                'name' => 'BOUISMAIL',
                'code' => '444',
                'dre_id' => '10',
                'category_id' => '4',
            ),
            111 => 
            array (
                'id' => '112',
                'name' => 'CHERCHELL',
                'code' => '427',
                'dre_id' => '10',
                'category_id' => '3',
            ),
            112 => 
            array (
                'id' => '113',
                'name' => 'HADJOUT',
                'code' => '439',
                'dre_id' => '10',
                'category_id' => '4',
            ),
            113 => 
            array (
                'id' => '114',
                'name' => 'AP KOLEA',
                'code' => '441',
                'dre_id' => '10',
                'category_id' => '1',
            ),
            114 => 
            array (
                'id' => '115',
                'name' => 'STAOUELI',
                'code' => '440',
                'dre_id' => '10',
                'category_id' => '4',
            ),
            115 => 
            array (
                'id' => '116',
                'name' => 'TIPASA',
                'code' => '438',
                'dre_id' => '10',
                'category_id' => '3',
            ),
            116 => 
            array (
                'id' => '117',
                'name' => 'ZERALDA',
                'code' => '428',
                'dre_id' => '10',
                'category_id' => '4',
            ),
            117 => 
            array (
                'id' => '118',
                'name' => 'AP BOUFARIK',
                'code' => '430',
                'dre_id' => '11',
                'category_id' => '1',
            ),
            118 => 
            array (
                'id' => '119',
                'name' => 'AP BLIDA',
                'code' => '442',
                'dre_id' => '11',
                'category_id' => '1',
            ),
            119 => 
            array (
                'id' => '120',
                'name' => 'AG BLIDA "Bananiers"',
                'code' => '445',
                'dre_id' => '11',
                'category_id' => '4',
            ),
            120 => 
            array (
                'id' => '121',
                'name' => 'AG BLIDA',
                'code' => '431',
                'dre_id' => '11',
                'category_id' => '4',
            ),
            121 => 
            array (
                'id' => '122',
                'name' => 'AG ELAFFROUNE',
                'code' => '437',
                'dre_id' => '11',
                'category_id' => '4',
            ),
            122 => 
            array (
                'id' => '123',
                'name' => 'AP MEDEA',
                'code' => '851',
                'dre_id' => '11',
                'category_id' => '1',
            ),
            123 => 
            array (
                'id' => '124',
                'name' => 'AG BERROUAGHIA',
                'code' => '849',
                'dre_id' => '11',
                'category_id' => '3',
            ),
            124 => 
            array (
                'id' => '125',
                'name' => 'AG KSAR EL BOUKHARI',
                'code' => '858',
                'dre_id' => '11',
                'category_id' => '4',
            ),
            125 => 
            array (
                'id' => '126',
                'name' => 'AG AIN OUSSERA',
                'code' => '653',
                'dre_id' => '11',
                'category_id' => '2',
            ),
            126 => 
            array (
                'id' => '127',
                'name' => 'AP DJELFA',
                'code' => '654',
                'dre_id' => '11',
                'category_id' => '1',
            ),
            127 => 
            array (
                'id' => '128',
                'name' => 'THENIA',
                'code' => '631',
                'dre_id' => '12',
                'category_id' => '3',
            ),
            128 => 
            array (
                'id' => '129',
                'name' => 'AP ROUIBA',
                'code' => '632',
                'dre_id' => '12',
                'category_id' => '1',
            ),
            129 => 
            array (
                'id' => '130',
                'name' => 'ROUIBA SNVI',
                'code' => '639',
                'dre_id' => '12',
                'category_id' => '4',
            ),
            130 => 
            array (
                'id' => '131',
                'name' => 'AP BORDJ EL KIFFAN',
                'code' => '640',
                'dre_id' => '12',
                'category_id' => '1',
            ),
            131 => 
            array (
                'id' => '132',
                'name' => 'AP ROUIBA',
                'code' => '641',
                'dre_id' => '12',
                'category_id' => '1',
            ),
            132 => 
            array (
                'id' => '133',
                'name' => 'RAGHAIA',
                'code' => '644',
                'dre_id' => '12',
                'category_id' => '3',
            ),
            133 => 
            array (
                'id' => '134',
                'name' => 'BOUMERDES',
                'code' => '645',
                'dre_id' => '12',
                'category_id' => '3',
            ),
            134 => 
            array (
                'id' => '135',
                'name' => 'AIN TAYA',
                'code' => '646',
                'dre_id' => '12',
                'category_id' => '3',
            ),
            135 => 
            array (
                'id' => '136',
                'name' => 'EL HAMIZ',
                'code' => '649',
                'dre_id' => '12',
                'category_id' => '4',
            ),
            136 => 
            array (
                'id' => '137',
                'name' => 'RAGHAIA "II"',
                'code' => '650',
                'dre_id' => '12',
                'category_id' => '4',
            ),
            137 => 
            array (
                'id' => '138',
                'name' => 'bordj el bahri',
                'code' => '651',
                'dre_id' => '12',
                'category_id' => '4',
            ),
            138 => 
            array (
                'id' => '139',
                'name' => 'AKBOU',
                'code' => '590',
                'dre_id' => '13',
                'category_id' => '4',
            ),
            139 => 
            array (
                'id' => '140',
                'name' => ' BEJAIA II',
                'code' => '588',
                'dre_id' => '13',
                'category_id' => '4',
            ),
            140 => 
            array (
                'id' => '141',
                'name' => ' AP BEJAIA',
                'code' => '356',
                'dre_id' => '13',
                'category_id' => '1',
            ),
            141 => 
            array (
                'id' => '142',
                'name' => 'TAZMALT',
                'code' => '586',
                'dre_id' => '13',
                'category_id' => '3',
            ),
            142 => 
            array (
                'id' => '143',
                'name' => ' JIJEL',
                'code' => '671',
                'dre_id' => '13',
                'category_id' => '3',
            ),
            143 => 
            array (
                'id' => '144',
                'name' => 'EL-KSEUR',
                'code' => '585',
                'dre_id' => '13',
                'category_id' => '3',
            ),
            144 => 
            array (
                'id' => '145',
                'name' => 'IHADDADENE',
                'code' => '587',
                'dre_id' => '13',
                'category_id' => '4',
            ),
            145 => 
            array (
                'id' => '146',
                'name' => 'AOKAS',
                'code' => '589',
                'dre_id' => '13',
                'category_id' => '4',
            ),
            146 => 
            array (
                'id' => '147',
                'name' => 'GHARDAIA',
                'code' => '291',
                'dre_id' => '14',
                'category_id' => '2',
            ),
            147 => 
            array (
                'id' => '148',
                'name' => 'GHARDAIA',
                'code' => '292',
                'dre_id' => '14',
                'category_id' => '4',
            ),
            148 => 
            array (
                'id' => '149',
                'name' => 'BERRIANE',
                'code' => '294',
                'dre_id' => '14',
                'category_id' => '4',
            ),
            149 => 
            array (
                'id' => '150',
                'name' => 'GUERRARA',
                'code' => '295',
                'dre_id' => '14',
                'category_id' => '3',
            ),
            150 => 
            array (
                'id' => '151',
                'name' => 'METLILI',
                'code' => '296',
                'dre_id' => '14',
                'category_id' => '2',
            ),
            151 => 
            array (
                'id' => '152',
                'name' => 'AFLOU',
                'code' => '297',
                'dre_id' => '14',
                'category_id' => '3',
            ),
            152 => 
            array (
                'id' => '153',
                'name' => 'AP LAGHOUAT',
                'code' => '301',
                'dre_id' => '14',
                'category_id' => '1',
            ),
            153 => 
            array (
                'id' => '154',
                'name' => 'AG Khenchela',
                'code' => '315',
                'dre_id' => '15',
                'category_id' => '2',
            ),
            154 => 
            array (
                'id' => '155',
                'name' => 'AG O.E.B',
                'code' => '316',
                'dre_id' => '15',
                'category_id' => '4',
            ),
            155 => 
            array (
                'id' => '156',
                'name' => 'AG Ain Beida',
                'code' => '321',
                'dre_id' => '15',
                'category_id' => '2',
            ),
            156 => 
            array (
                'id' => '157',
                'name' => 'AG Khenchela',
                'code' => '323',
                'dre_id' => '15',
                'category_id' => '2',
            ),
            157 => 
            array (
                'id' => '158',
                'name' => 'AG Tébessa',
                'code' => '483',
                'dre_id' => '15',
                'category_id' => '3',
            ),
            158 => 
            array (
                'id' => '159',
                'name' => 'AG Ouenza',
                'code' => '484',
                'dre_id' => '15',
                'category_id' => '4',
            ),
            159 => 
            array (
                'id' => '160',
                'name' => 'AG Bir El Ater',
                'code' => '486',
                'dre_id' => '15',
                'category_id' => '3',
            ),
            160 => 
            array (
                'id' => '161',
                'name' => 'AP Tébessa',
                'code' => '491',
                'dre_id' => '15',
                'category_id' => '1',
            ),
            161 => 
            array (
                'id' => '162',
                'name' => 'AG Ain Beida',
                'code' => '800',
                'dre_id' => '15',
                'category_id' => '4',
            ),
            162 => 
            array (
                'id' => '163',
                'name' => 'AG O.E.B',
                'code' => '842',
                'dre_id' => '15',
                'category_id' => '3',
            ),
            163 => 
            array (
                'id' => '164',
                'name' => 'AP CHE GUEVARA',
                'code' => '599',
                'dre_id' => '16',
                'category_id' => '1',
            ),
            164 => 
            array (
                'id' => '165',
                'name' => 'AP TELEMLY',
                'code' => '602',
                'dre_id' => '16',
                'category_id' => '1',
            ),
            165 => 
            array (
                'id' => '166',
                'name' => 'AP LIBERTE',
                'code' => '605',
                'dre_id' => '16',
                'category_id' => '1',
            ),
            166 => 
            array (
                'id' => '167',
                'name' => 'BOLOGHINE',
                'code' => '608',
                'dre_id' => '16',
                'category_id' => '2',
            ),
            167 => 
            array (
                'id' => '168',
                'name' => 'AP ZIROUT YOUCEF',
                'code' => '620',
                'dre_id' => '16',
                'category_id' => '1',
            ),
            168 => 
            array (
                'id' => '169',
                'name' => 'AP BOUZAREAH',
                'code' => '627',
                'dre_id' => '16',
                'category_id' => '1',
            ),
            169 => 
            array (
                'id' => '170',
                'name' => 'AGENCE PORT SAID',
                'code' => '628',
                'dre_id' => '16',
                'category_id' => '4',
            ),
            170 => 
            array (
                'id' => '171',
                'name' => 'BAB EL OUED',
                'code' => '629',
                'dre_id' => '16',
                'category_id' => '4',
            ),
            171 => 
            array (
                'id' => '172',
                'name' => 'AP DIDOUCHE MOURAD',
                'code' => '601',
                'dre_id' => '17',
                'category_id' => '1',
            ),
            172 => 
            array (
                'id' => '173',
                'name' => 'HYDRA',
                'code' => '603',
                'dre_id' => '17',
                'category_id' => '2',
            ),
            173 => 
            array (
                'id' => '174',
                'name' => 'AG B',
                'code' => '607',
                'dre_id' => '17',
                'category_id' => '3',
            ),
            174 => 
            array (
                'id' => '175',
                'name' => 'AG D',
                'code' => '609',
                'dre_id' => '17',
                'category_id' => '2',
            ),
            175 => 
            array (
                'id' => '176',
                'name' => 'AP LES HALLES',
                'code' => '610',
                'dre_id' => '17',
                'category_id' => '1',
            ),
            176 => 
            array (
                'id' => '177',
                'name' => 'AP H.DEY',
                'code' => '611',
                'dre_id' => '17',
                'category_id' => '1',
            ),
            177 => 
            array (
                'id' => '178',
                'name' => 'AG N',
                'code' => '614',
                'dre_id' => '17',
                'category_id' => '2',
            ),
            178 => 
            array (
                'id' => '179',
                'name' => 'BELADJEL',
                'code' => '615',
                'dre_id' => '17',
                'category_id' => '3',
            ),
            179 => 
            array (
                'id' => '180',
                'name' => 'RIAD EL FETH',
                'code' => '617',
                'dre_id' => '17',
                'category_id' => '2',
            ),
            180 => 
            array (
                'id' => '181',
                'name' => 'AP EL BIAR',
                'code' => '621',
                'dre_id' => '17',
                'category_id' => '1',
            ),
            181 => 
            array (
                'id' => '182',
                'name' => 'CHERAGA',
                'code' => '622',
                'dre_id' => '17',
                'category_id' => '4',
            ),
            182 => 
            array (
                'id' => '183',
                'name' => 'AP LARBI BEN M\'HIDI',
                'code' => '623',
                'dre_id' => '17',
                'category_id' => '1',
            ),
            183 => 
            array (
                'id' => '184',
                'name' => 'PLE AGHA',
                'code' => '626',
                'dre_id' => '17',
                'category_id' => '1',
            ),
            184 => 
            array (
                'id' => '185',
                'name' => 'CHLEF',
                'code' => '260',
                'dre_id' => '18',
                'category_id' => '2',
            ),
            185 => 
            array (
                'id' => '186',
                'name' => 'MILIANA',
                'code' => '262',
                'dre_id' => '18',
                'category_id' => '3',
            ),
            186 => 
            array (
                'id' => '187',
                'name' => 'AIN DEFLA',
                'code' => '268',
                'dre_id' => '18',
                'category_id' => '1',
            ),
            187 => 
            array (
                'id' => '188',
                'name' => 'EL ATTAF',
                'code' => '272',
                'dre_id' => '18',
                'category_id' => '4',
            ),
            188 => 
            array (
                'id' => '189',
                'name' => 'CHLEF',
                'code' => '275',
                'dre_id' => '18',
                'category_id' => '1',
            ),
            189 => 
            array (
                'id' => '190',
                'name' => 'OUED R\'HIOU',
                'code' => '276',
                'dre_id' => '18',
                'category_id' => '4',
            ),
            190 => 
            array (
                'id' => '191',
                'name' => 'TISSEMSILT',
                'code' => '277',
                'dre_id' => '18',
                'category_id' => '4',
            ),
            191 => 
            array (
                'id' => '192',
                'name' => 'KHEMIS MILIANA',
                'code' => '278',
                'dre_id' => '18',
                'category_id' => '4',
            ),
            192 => 
            array (
                'id' => '193',
                'name' => 'TENES',
                'code' => '279',
                'dre_id' => '18',
                'category_id' => '4',
            ),
            193 => 
            array (
                'id' => '194',
                'name' => 'AMOUCHA',
                'code' => '338',
                'dre_id' => '19',
                'category_id' => '4',
            ),
            194 => 
            array (
                'id' => '195',
                'name' => 'BOUSSAADA',
                'code' => '701',
                'dre_id' => '19',
                'category_id' => '4',
            ),
            195 => 
            array (
                'id' => '196',
                'name' => 'AIN EL KEBIRA',
                'code' => '702',
                'dre_id' => '19',
                'category_id' => '4',
            ),
            196 => 
            array (
                'id' => '197',
                'name' => 'SETIF MAABOUDA',
                'code' => '703',
                'dre_id' => '19',
                'category_id' => '4',
            ),
            197 => 
            array (
                'id' => '198',
                'name' => 'M\'SILA',
                'code' => '901',
                'dre_id' => '19',
                'category_id' => '2',
            ),
            198 => 
            array (
                'id' => '199',
                'name' => 'AP SETIF',
                'code' => '704',
                'dre_id' => '19',
                'category_id' => '1',
            ),
            199 => 
            array (
                'id' => '200',
                'name' => 'BORDJ BOU ARRERIDJ',
                'code' => '705',
                'dre_id' => '19',
                'category_id' => '3',
            ),
            200 => 
            array (
                'id' => '201',
                'name' => 'EL EULMA',
                'code' => '706',
                'dre_id' => '19',
                'category_id' => '3',
            ),
            201 => 
            array (
                'id' => '202',
                'name' => 'AIN EL MELH',
                'code' => '707',
                'dre_id' => '19',
                'category_id' => '3',
            ),
            202 => 
            array (
                'id' => '203',
                'name' => 'SIDI AISSA',
                'code' => '708',
                'dre_id' => '19',
                'category_id' => '4',
            ),
            203 => 
            array (
                'id' => '204',
                'name' => 'SETIF',
                'code' => '711',
                'dre_id' => '19',
                'category_id' => '4',
            ),
            204 => 
            array (
                'id' => '205',
                'name' => 'PARK MALL',
                'code' => '712',
                'dre_id' => '19',
                'category_id' => '4',
            ),
            205 => 
            array (
                'id' => '206',
                'name' => 'Ain Azel',
                'code' => '714',
                'dre_id' => '19',
                'category_id' => '4',
            ),
            206 => 
            array (
                'id' => '207',
                'name' => 'AP.TIARET',
                'code' => '540',
                'dre_id' => '20',
                'category_id' => '1',
            ),
            207 => 
            array (
                'id' => '208',
                'name' => 'AG.TIARET',
                'code' => '545',
                'dre_id' => '20',
                'category_id' => '4',
            ),
            208 => 
            array (
                'id' => '209',
                'name' => 'AG.SIG',
                'code' => '546',
                'dre_id' => '20',
                'category_id' => '4',
            ),
            209 => 
            array (
                'id' => '210',
                'name' => 'AG.TIARET SNVI',
                'code' => '548',
                'dre_id' => '20',
                'category_id' => '4',
            ),
            210 => 
            array (
                'id' => '211',
                'name' => 'AG.RELIZANE',
                'code' => '869',
                'dre_id' => '20',
                'category_id' => '2',
            ),
            211 => 
            array (
                'id' => '212',
                'name' => 'AG. MOSTAGANEM',
                'code' => '871',
                'dre_id' => '20',
                'category_id' => '3',
            ),
            212 => 
            array (
                'id' => '213',
                'name' => 'AP.MOSTAGANEM',
                'code' => '876',
                'dre_id' => '20',
                'category_id' => '1',
            ),
            213 => 
            array (
                'id' => '214',
                'name' => 'AG.TIGNHENNIF',
                'code' => '877',
                'dre_id' => '20',
                'category_id' => '4',
            ),
            214 => 
            array (
                'id' => '215',
                'name' => 'AG.MOSTAGANEM',
                'code' => '878',
                'dre_id' => '20',
                'category_id' => '4',
            ),
            215 => 
            array (
                'id' => '216',
                'name' => 'AG.MOHAMMADIA',
                'code' => '921',
                'dre_id' => '20',
                'category_id' => '4',
            ),
            216 => 
            array (
                'id' => '217',
                'name' => 'SAIDA',
                'code' => '724',
                'dre_id' => '21',
                'category_id' => '3',
            ),
            217 => 
            array (
                'id' => '218',
                'name' => 'El BAYADH',
                'code' => '726',
                'dre_id' => '21',
                'category_id' => '3',
            ),
            218 => 
            array (
                'id' => '219',
                'name' => 'AIN TEMOUCHT',
                'code' => '728',
                'dre_id' => '21',
                'category_id' => '4',
            ),
            219 => 
            array (
                'id' => '220',
                'name' => 'EL MALLAH',
                'code' => '771',
                'dre_id' => '21',
                'category_id' => '4',
            ),
            220 => 
            array (
                'id' => '221',
                'name' => 'SIDI BEL ABBES',
                'code' => '773',
                'dre_id' => '21',
                'category_id' => '1',
            ),
            221 => 
            array (
                'id' => '222',
                'name' => 'SIDI BEL ABBES',
                'code' => '774',
                'dre_id' => '21',
                'category_id' => '4',
            ),
            222 => 
            array (
                'id' => '223',
                'name' => 'TELAGH',
                'code' => '870',
                'dre_id' => '21',
                'category_id' => '4',
            ),
            223 => 
            array (
                'id' => '224',
                'name' => 'MASCARA',
                'code' => '920',
                'dre_id' => '21',
                'category_id' => '2',
            ),
        ));
        
        
    }
}