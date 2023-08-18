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
                'id' => 'A515650D-1702-4236-A439-4944783AC815',
                'reference' => 'RAP202301/633',
            'note' => '<p class="ql-align-justify">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>',
                'control_campaign_id' => '1',
                'agency_id' => '114',
                'created_by_id' => '44',
                'cdcr_validation_by_id' => '26',
                'dcp_validation_by_id' => '2',
                'cdc_validation_by_id' => '44',
                'ci_validation_by_id' => '45',
                'cc_validation_by_id' => NULL,
                'programmed_start' => '2023-07-30 00:00:00.0000000',
                'programmed_end' => '2023-08-03 00:00:00.0000000',
                'reel_start' => '2023-07-30 12:15:29.0000000',
                'reel_end' => NULL,
                'cdc_validation_at' => '2023-08-02 20:53:58.0000000',
                'ci_validation_at' => '2023-08-02 20:53:06.0000000',
                'cc_validation_at' => NULL,
                'cdcr_validation_at' => '2023-08-02 20:54:28.0000000',
                'dcp_validation_at' => '2023-08-02 20:54:53.0000000',
                'created_at' => '2023-07-30 11:49:42.0000000',
                'updated_at' => '2023-08-02 20:54:53.0000000',
                'deleted_at' => NULL,
                'da_validation_by_id' => NULL,
                'da_validation_at' => NULL,
            ),
            1 => 
            array (
                'id' => 'FA60045C-C4FD-457F-905E-5DB6D5260066',
                'reference' => 'RAP202302/633',
                'note' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Bibendum est ultricies integer quis auctor elit. Mauris pharetra et ultrices neque ornare aenean euismod elementum. Pharetra diam sit amet nisl suscipit adipiscing bibendum. Ac orci phasellus egestas tellus. Risus sed vulputate odio ut enim blandit volutpat. Lacus sed turpis tincidunt id aliquet. Dolor sed viverra ipsum nunc aliquet bibendum. Dui nunc mattis enim ut tellus elementum sagittis vitae. Sit amet aliquam id diam maecenas ultricies mi. Dui id ornare arcu odio ut sem nulla. Natoque penatibus et magnis dis parturient montes nascetur ridiculus. At urna condimentum mattis pellentesque id nibh tortor. Senectus et netus et malesuada fames. Consectetur a erat nam at lectus urna duis convallis. Libero justo laoreet sit amet cursus sit amet. Elementum tempus egestas sed sed risus pretium quam. Commodo elit at imperdiet dui accumsan sit.</p>',
                'control_campaign_id' => '2',
                'agency_id' => '114',
                'created_by_id' => '44',
                'cdcr_validation_by_id' => '47',
                'dcp_validation_by_id' => '2',
                'cdc_validation_by_id' => '44',
                'ci_validation_by_id' => '45',
                'cc_validation_by_id' => '19',
                'programmed_start' => '2023-08-17 00:00:00.0000000',
                'programmed_end' => '2023-08-25 00:00:00.0000000',
                'reel_start' => '2023-08-17 20:08:36.2640000',
                'reel_end' => '2023-08-17 20:08:36.2800000',
                'cdc_validation_at' => '2023-08-17 20:13:15.0400000',
                'ci_validation_at' => '2023-08-17 20:10:56.2470000',
                'cc_validation_at' => '2023-08-18 10:22:06.2920000',
                'cdcr_validation_at' => '2023-08-18 10:23:40.1260000',
                'dcp_validation_at' => '2023-08-18 10:25:23.5730000',
                'created_at' => '2023-08-17 17:52:43.1310000',
                'updated_at' => '2023-08-18 10:25:23.5730000',
                'deleted_at' => NULL,
                'da_validation_by_id' => NULL,
                'da_validation_at' => NULL,
            ),
        ));
        
        
    }
}