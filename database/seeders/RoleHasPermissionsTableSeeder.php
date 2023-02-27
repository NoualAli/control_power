<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleHasPermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('role_has_permissions')->delete();
        
        \DB::table('role_has_permissions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'permission_id' => 1,
                'role_id' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'permission_id' => 2,
                'role_id' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'permission_id' => 3,
                'role_id' => 1,
            ),
            3 => 
            array (
                'id' => 4,
                'permission_id' => 4,
                'role_id' => 1,
            ),
            4 => 
            array (
                'id' => 5,
                'permission_id' => 5,
                'role_id' => 1,
            ),
            5 => 
            array (
                'id' => 6,
                'permission_id' => 6,
                'role_id' => 1,
            ),
            6 => 
            array (
                'id' => 7,
                'permission_id' => 7,
                'role_id' => 1,
            ),
            7 => 
            array (
                'id' => 8,
                'permission_id' => 8,
                'role_id' => 1,
            ),
            8 => 
            array (
                'id' => 9,
                'permission_id' => 9,
                'role_id' => 1,
            ),
            9 => 
            array (
                'id' => 10,
                'permission_id' => 10,
                'role_id' => 1,
            ),
            10 => 
            array (
                'id' => 11,
                'permission_id' => 11,
                'role_id' => 1,
            ),
            11 => 
            array (
                'id' => 12,
                'permission_id' => 12,
                'role_id' => 1,
            ),
            12 => 
            array (
                'id' => 13,
                'permission_id' => 13,
                'role_id' => 1,
            ),
            13 => 
            array (
                'id' => 14,
                'permission_id' => 14,
                'role_id' => 1,
            ),
            14 => 
            array (
                'id' => 15,
                'permission_id' => 15,
                'role_id' => 1,
            ),
            15 => 
            array (
                'id' => 16,
                'permission_id' => 16,
                'role_id' => 1,
            ),
            16 => 
            array (
                'id' => 17,
                'permission_id' => 17,
                'role_id' => 1,
            ),
            17 => 
            array (
                'id' => 18,
                'permission_id' => 18,
                'role_id' => 1,
            ),
            18 => 
            array (
                'id' => 19,
                'permission_id' => 19,
                'role_id' => 1,
            ),
            19 => 
            array (
                'id' => 20,
                'permission_id' => 20,
                'role_id' => 1,
            ),
            20 => 
            array (
                'id' => 21,
                'permission_id' => 21,
                'role_id' => 1,
            ),
            21 => 
            array (
                'id' => 22,
                'permission_id' => 22,
                'role_id' => 1,
            ),
            22 => 
            array (
                'id' => 23,
                'permission_id' => 23,
                'role_id' => 1,
            ),
            23 => 
            array (
                'id' => 24,
                'permission_id' => 24,
                'role_id' => 1,
            ),
            24 => 
            array (
                'id' => 25,
                'permission_id' => 25,
                'role_id' => 1,
            ),
            25 => 
            array (
                'id' => 26,
                'permission_id' => 26,
                'role_id' => 1,
            ),
            26 => 
            array (
                'id' => 27,
                'permission_id' => 27,
                'role_id' => 1,
            ),
            27 => 
            array (
                'id' => 28,
                'permission_id' => 28,
                'role_id' => 1,
            ),
            28 => 
            array (
                'id' => 29,
                'permission_id' => 29,
                'role_id' => 1,
            ),
            29 => 
            array (
                'id' => 30,
                'permission_id' => 30,
                'role_id' => 1,
            ),
            30 => 
            array (
                'id' => 31,
                'permission_id' => 31,
                'role_id' => 1,
            ),
            31 => 
            array (
                'id' => 32,
                'permission_id' => 32,
                'role_id' => 1,
            ),
            32 => 
            array (
                'id' => 33,
                'permission_id' => 33,
                'role_id' => 1,
            ),
            33 => 
            array (
                'id' => 34,
                'permission_id' => 34,
                'role_id' => 1,
            ),
            34 => 
            array (
                'id' => 35,
                'permission_id' => 35,
                'role_id' => 1,
            ),
            35 => 
            array (
                'id' => 36,
                'permission_id' => 36,
                'role_id' => 1,
            ),
            36 => 
            array (
                'id' => 37,
                'permission_id' => 37,
                'role_id' => 1,
            ),
            37 => 
            array (
                'id' => 38,
                'permission_id' => 8,
                'role_id' => 7,
            ),
            38 => 
            array (
                'id' => 39,
                'permission_id' => 14,
                'role_id' => 7,
            ),
            39 => 
            array (
                'id' => 40,
                'permission_id' => 15,
                'role_id' => 7,
            ),
            40 => 
            array (
                'id' => 41,
                'permission_id' => 16,
                'role_id' => 7,
            ),
            41 => 
            array (
                'id' => 42,
                'permission_id' => 17,
                'role_id' => 7,
            ),
            42 => 
            array (
                'id' => 43,
                'permission_id' => 18,
                'role_id' => 7,
            ),
            43 => 
            array (
                'id' => 44,
                'permission_id' => 19,
                'role_id' => 7,
            ),
            44 => 
            array (
                'id' => 45,
                'permission_id' => 20,
                'role_id' => 7,
            ),
            45 => 
            array (
                'id' => 46,
                'permission_id' => 21,
                'role_id' => 7,
            ),
            46 => 
            array (
                'id' => 47,
                'permission_id' => 22,
                'role_id' => 7,
            ),
            47 => 
            array (
                'id' => 48,
                'permission_id' => 23,
                'role_id' => 7,
            ),
            48 => 
            array (
                'id' => 49,
                'permission_id' => 24,
                'role_id' => 7,
            ),
            49 => 
            array (
                'id' => 50,
                'permission_id' => 25,
                'role_id' => 7,
            ),
            50 => 
            array (
                'id' => 51,
                'permission_id' => 26,
                'role_id' => 7,
            ),
            51 => 
            array (
                'id' => 52,
                'permission_id' => 27,
                'role_id' => 7,
            ),
            52 => 
            array (
                'id' => 53,
                'permission_id' => 28,
                'role_id' => 7,
            ),
            53 => 
            array (
                'id' => 54,
                'permission_id' => 29,
                'role_id' => 7,
            ),
            54 => 
            array (
                'id' => 55,
                'permission_id' => 30,
                'role_id' => 7,
            ),
            55 => 
            array (
                'id' => 56,
                'permission_id' => 31,
                'role_id' => 7,
            ),
            56 => 
            array (
                'id' => 57,
                'permission_id' => 32,
                'role_id' => 7,
            ),
            57 => 
            array (
                'id' => 58,
                'permission_id' => 33,
                'role_id' => 7,
            ),
            58 => 
            array (
                'id' => 59,
                'permission_id' => 34,
                'role_id' => 7,
            ),
            59 => 
            array (
                'id' => 60,
                'permission_id' => 35,
                'role_id' => 7,
            ),
            60 => 
            array (
                'id' => 61,
                'permission_id' => 36,
                'role_id' => 7,
            ),
            61 => 
            array (
                'id' => 62,
                'permission_id' => 37,
                'role_id' => 7,
            ),
            62 => 
            array (
                'id' => 63,
                'permission_id' => 5,
                'role_id' => 7,
            ),
            63 => 
            array (
                'id' => 64,
                'permission_id' => 13,
                'role_id' => 7,
            ),
            64 => 
            array (
                'id' => 65,
                'permission_id' => 38,
                'role_id' => 3,
            ),
            65 => 
            array (
                'id' => 66,
                'permission_id' => 39,
                'role_id' => 3,
            ),
            66 => 
            array (
                'id' => 67,
                'permission_id' => 40,
                'role_id' => 3,
            ),
            67 => 
            array (
                'id' => 68,
                'permission_id' => 41,
                'role_id' => 3,
            ),
            68 => 
            array (
                'id' => 69,
                'permission_id' => 42,
                'role_id' => 5,
            ),
            69 => 
            array (
                'id' => 70,
                'permission_id' => 43,
                'role_id' => 5,
            ),
            70 => 
            array (
                'id' => 71,
                'permission_id' => 44,
                'role_id' => 5,
            ),
            71 => 
            array (
                'id' => 72,
                'permission_id' => 45,
                'role_id' => 5,
            ),
            72 => 
            array (
                'id' => 73,
                'permission_id' => 46,
                'role_id' => 6,
            ),
            73 => 
            array (
                'id' => 74,
                'permission_id' => 40,
                'role_id' => 6,
            ),
            74 => 
            array (
                'id' => 75,
                'permission_id' => 45,
                'role_id' => 6,
            ),
            75 => 
            array (
                'id' => 76,
                'permission_id' => 40,
                'role_id' => 5,
            ),
            76 => 
            array (
                'id' => 77,
                'permission_id' => 47,
                'role_id' => 6,
            ),
            77 => 
            array (
                'id' => 78,
                'permission_id' => 48,
                'role_id' => 5,
            ),
            78 => 
            array (
                'id' => 79,
                'permission_id' => 45,
                'role_id' => 3,
            ),
            79 => 
            array (
                'id' => 80,
                'permission_id' => 50,
                'role_id' => 5,
            ),
            80 => 
            array (
                'id' => 81,
                'permission_id' => 49,
                'role_id' => 5,
            ),
            81 => 
            array (
                'id' => 82,
                'permission_id' => 51,
                'role_id' => 6,
            ),
            82 => 
            array (
                'id' => 83,
                'permission_id' => 49,
                'role_id' => 6,
            ),
            83 => 
            array (
                'id' => 84,
                'permission_id' => 49,
                'role_id' => 3,
            ),
            84 => 
            array (
                'id' => 85,
                'permission_id' => 40,
                'role_id' => 2,
            ),
            85 => 
            array (
                'id' => 86,
                'permission_id' => 45,
                'role_id' => 2,
            ),
            86 => 
            array (
                'id' => 87,
                'permission_id' => 49,
                'role_id' => 2,
            ),
            87 => 
            array (
                'id' => 88,
                'permission_id' => 49,
                'role_id' => 8,
            ),
            88 => 
            array (
                'id' => 89,
                'permission_id' => 45,
                'role_id' => 8,
            ),
            89 => 
            array (
                'id' => 90,
                'permission_id' => 40,
                'role_id' => 8,
            ),
            90 => 
            array (
                'id' => 91,
                'permission_id' => 49,
                'role_id' => 4,
            ),
            91 => 
            array (
                'id' => 92,
                'permission_id' => 45,
                'role_id' => 4,
            ),
            92 => 
            array (
                'id' => 93,
                'permission_id' => 40,
                'role_id' => 4,
            ),
            93 => 
            array (
                'id' => 96,
                'permission_id' => 52,
                'role_id' => 2,
            ),
            94 => 
            array (
                'id' => 97,
                'permission_id' => 52,
                'role_id' => 3,
            ),
            95 => 
            array (
                'id' => 98,
                'permission_id' => 52,
                'role_id' => 5,
            ),
            96 => 
            array (
                'id' => 99,
                'permission_id' => 52,
                'role_id' => 4,
            ),
            97 => 
            array (
                'id' => 100,
                'permission_id' => 52,
                'role_id' => 8,
            ),
            98 => 
            array (
                'id' => 101,
                'permission_id' => 45,
                'role_id' => 10,
            ),
            99 => 
            array (
                'id' => 102,
                'permission_id' => 49,
                'role_id' => 10,
            ),
            100 => 
            array (
                'id' => 103,
                'permission_id' => 40,
                'role_id' => 10,
            ),
            101 => 
            array (
                'id' => 104,
                'permission_id' => 53,
                'role_id' => 5,
            ),
            102 => 
            array (
                'id' => 105,
                'permission_id' => 53,
                'role_id' => 6,
            ),
            103 => 
            array (
                'id' => 106,
                'permission_id' => 54,
                'role_id' => 4,
            ),
            104 => 
            array (
                'id' => 107,
                'permission_id' => 54,
                'role_id' => 3,
            ),
            105 => 
            array (
                'id' => 108,
                'permission_id' => 54,
                'role_id' => 5,
            ),
            106 => 
            array (
                'id' => 109,
                'permission_id' => 54,
                'role_id' => 8,
            ),
            107 => 
            array (
                'id' => 110,
                'permission_id' => 54,
                'role_id' => 2,
            ),
            108 => 
            array (
                'id' => 111,
                'permission_id' => 54,
                'role_id' => 9,
            ),
            109 => 
            array (
                'id' => 112,
                'permission_id' => 54,
                'role_id' => 10,
            ),
            110 => 
            array (
                'id' => 113,
                'permission_id' => 55,
                'role_id' => 10,
            ),
            111 => 
            array (
                'id' => 114,
                'permission_id' => 55,
                'role_id' => 4,
            ),
            112 => 
            array (
                'id' => 115,
                'permission_id' => 56,
                'role_id' => 4,
            ),
            113 => 
            array (
                'id' => 116,
                'permission_id' => 8,
                'role_id' => 4,
            ),
            114 => 
            array (
                'id' => 118,
                'permission_id' => 57,
                'role_id' => 10,
            ),
            115 => 
            array (
                'id' => 119,
                'permission_id' => 58,
                'role_id' => 3,
            ),
            116 => 
            array (
                'id' => 120,
                'permission_id' => 59,
                'role_id' => 2,
            ),
            117 => 
            array (
                'id' => 121,
                'permission_id' => 59,
                'role_id' => 3,
            ),
            118 => 
            array (
                'id' => 122,
                'permission_id' => 59,
                'role_id' => 5,
            ),
            119 => 
            array (
                'id' => 123,
                'permission_id' => 59,
                'role_id' => 4,
            ),
            120 => 
            array (
                'id' => 124,
                'permission_id' => 59,
                'role_id' => 8,
            ),
            121 => 
            array (
                'id' => 125,
                'permission_id' => 59,
                'role_id' => 9,
            ),
            122 => 
            array (
                'id' => 126,
                'permission_id' => 59,
                'role_id' => 7,
            ),
            123 => 
            array (
                'id' => 127,
                'permission_id' => 59,
                'role_id' => 10,
            ),
            124 => 
            array (
                'id' => 128,
                'permission_id' => 60,
                'role_id' => 1,
            ),
            125 => 
            array (
                'id' => 129,
                'permission_id' => 60,
                'role_id' => 7,
            ),
            126 => 
            array (
                'id' => 130,
                'permission_id' => 61,
                'role_id' => 1,
            ),
            127 => 
            array (
                'id' => 131,
                'permission_id' => 62,
                'role_id' => 1,
            ),
            128 => 
            array (
                'id' => 132,
                'permission_id' => 63,
                'role_id' => 1,
            ),
            129 => 
            array (
                'id' => 133,
                'permission_id' => 63,
                'role_id' => 7,
            ),
            130 => 
            array (
                'id' => 134,
                'permission_id' => 64,
                'role_id' => 1,
            ),
            131 => 
            array (
                'id' => 135,
                'permission_id' => 64,
                'role_id' => 7,
            ),
            132 => 
            array (
                'id' => 136,
                'permission_id' => 65,
                'role_id' => 1,
            ),
            133 => 
            array (
                'id' => 137,
                'permission_id' => 65,
                'role_id' => 7,
            ),
            134 => 
            array (
                'id' => 138,
                'permission_id' => 66,
                'role_id' => 7,
            ),
            135 => 
            array (
                'id' => 139,
                'permission_id' => 66,
                'role_id' => 1,
            ),
            136 => 
            array (
                'id' => 140,
                'permission_id' => 67,
                'role_id' => 7,
            ),
            137 => 
            array (
                'id' => 141,
                'permission_id' => 67,
                'role_id' => 1,
            ),
            138 => 
            array (
                'id' => 142,
                'permission_id' => 68,
                'role_id' => 7,
            ),
            139 => 
            array (
                'id' => 143,
                'permission_id' => 68,
                'role_id' => 1,
            ),
            140 => 
            array (
                'id' => 144,
                'permission_id' => 69,
                'role_id' => 3,
            ),
            141 => 
            array (
                'id' => 145,
                'permission_id' => 69,
                'role_id' => 4,
            ),
            142 => 
            array (
                'id' => 146,
                'permission_id' => 69,
                'role_id' => 8,
            ),
            143 => 
            array (
                'id' => 147,
                'permission_id' => 69,
                'role_id' => 2,
            ),
            144 => 
            array (
                'id' => 148,
                'permission_id' => 69,
                'role_id' => 5,
            ),
            145 => 
            array (
                'id' => 149,
                'permission_id' => 69,
                'role_id' => 6,
            ),
            146 => 
            array (
                'id' => 150,
                'permission_id' => 69,
                'role_id' => 10,
            ),
            147 => 
            array (
                'id' => 151,
                'permission_id' => 70,
                'role_id' => 9,
            ),
            148 => 
            array (
                'id' => 152,
                'permission_id' => 70,
                'role_id' => 2,
            ),
            149 => 
            array (
                'id' => 153,
                'permission_id' => 70,
                'role_id' => 3,
            ),
            150 => 
            array (
                'id' => 154,
                'permission_id' => 70,
                'role_id' => 4,
            ),
            151 => 
            array (
                'id' => 155,
                'permission_id' => 71,
                'role_id' => 3,
            ),
            152 => 
            array (
                'id' => 156,
                'permission_id' => 71,
                'role_id' => 4,
            ),
            153 => 
            array (
                'id' => 157,
                'permission_id' => 71,
                'role_id' => 8,
            ),
            154 => 
            array (
                'id' => 158,
                'permission_id' => 71,
                'role_id' => 2,
            ),
            155 => 
            array (
                'id' => 159,
                'permission_id' => 71,
                'role_id' => 5,
            ),
            156 => 
            array (
                'id' => 160,
                'permission_id' => 71,
                'role_id' => 6,
            ),
            157 => 
            array (
                'id' => 162,
                'permission_id' => 71,
                'role_id' => 10,
            ),
            158 => 
            array (
                'id' => 163,
                'permission_id' => 52,
                'role_id' => 9,
            ),
            159 => 
            array (
                'id' => 164,
                'permission_id' => 40,
                'role_id' => 9,
            ),
            160 => 
            array (
                'id' => 165,
                'permission_id' => 52,
                'role_id' => 6,
            ),
            161 => 
            array (
                'id' => 166,
                'permission_id' => 70,
                'role_id' => 6,
            ),
            162 => 
            array (
                'id' => 167,
                'permission_id' => 70,
                'role_id' => 5,
            ),
            163 => 
            array (
                'id' => 168,
                'permission_id' => 72,
                'role_id' => 4,
            ),
            164 => 
            array (
                'id' => 169,
                'permission_id' => 73,
                'role_id' => 3,
            ),
            165 => 
            array (
                'id' => 170,
                'permission_id' => 49,
                'role_id' => 11,
            ),
            166 => 
            array (
                'id' => 174,
                'permission_id' => 74,
                'role_id' => 11,
            ),
            167 => 
            array (
                'id' => 175,
                'permission_id' => 71,
                'role_id' => 11,
            ),
            168 => 
            array (
                'id' => 176,
                'permission_id' => 45,
                'role_id' => 11,
            ),
            169 => 
            array (
                'id' => 177,
                'permission_id' => 40,
                'role_id' => 12,
            ),
            170 => 
            array (
                'id' => 178,
                'permission_id' => 59,
                'role_id' => 12,
            ),
            171 => 
            array (
                'id' => 179,
                'permission_id' => 49,
                'role_id' => 12,
            ),
            172 => 
            array (
                'id' => 180,
                'permission_id' => 69,
                'role_id' => 12,
            ),
            173 => 
            array (
                'id' => 181,
                'permission_id' => 71,
                'role_id' => 12,
            ),
            174 => 
            array (
                'id' => 182,
                'permission_id' => 45,
                'role_id' => 12,
            ),
            175 => 
            array (
                'id' => 183,
                'permission_id' => 45,
                'role_id' => 13,
            ),
            176 => 
            array (
                'id' => 184,
                'permission_id' => 49,
                'role_id' => 13,
            ),
            177 => 
            array (
                'id' => 185,
                'permission_id' => 69,
                'role_id' => 13,
            ),
            178 => 
            array (
                'id' => 186,
                'permission_id' => 71,
                'role_id' => 13,
            ),
            179 => 
            array (
                'id' => 187,
                'permission_id' => 40,
                'role_id' => 13,
            ),
            180 => 
            array (
                'id' => 188,
                'permission_id' => 59,
                'role_id' => 13,
            ),
            181 => 
            array (
                'id' => 189,
                'permission_id' => 46,
                'role_id' => 5,
            ),
        ));
        
        
    }
}