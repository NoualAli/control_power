<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('missions')->delete();
        
        \DB::table('missions')->insert(array (
            0 => 
            array (
                'id' => 'a515650d-1702-4236-a439-4944783ac815',
                'reference' => 'RAP202301/633',
            'note' => '<p class="ql-align-justify">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>',
                'control_campaign_id' => 1,
                'agency_id' => 114,
                'created_by_id' => 44,
                'cdcr_validation_by_id' => 26,
                'dcp_validation_by_id' => 2,
                'cdc_validation_by_id' => 44,
                'ci_validation_by_id' => 45,
                'cc_validation_by_id' => NULL,
                'programmed_start' => '2023-07-30 00:00:00',
                'programmed_end' => '2023-08-03 00:00:00',
                'reel_start' => '2023-07-30 12:15:29',
                'reel_end' => NULL,
                'cdc_validation_at' => '2023-08-02 20:53:58',
                'ci_validation_at' => '2023-08-02 20:53:06',
                'cc_validation_at' => NULL,
                'cdcr_validation_at' => '2023-08-02 20:54:28',
                'dcp_validation_at' => '2023-08-02 20:54:53',
                'created_at' => '2023-07-30 11:49:42',
                'updated_at' => '2023-08-02 20:54:53',
                'deleted_at' => NULL,
                'da_validation_by_id' => NULL,
                'da_validation_at' => NULL,
            ),
        ));
        
        
    }
}