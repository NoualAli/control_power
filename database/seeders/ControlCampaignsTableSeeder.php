<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ControlCampaignsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('control_campaigns')->delete();
        
        \DB::table('control_campaigns')->insert(array (
            0 => 
            array (
                'id' => '1',
                'description' => '<p class="ql-align-justify"><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>',
                'reference' => 'CDC-2023-01',
                'created_by_id' => '2',
                'validated_by_id' => '2',
                'validated_at' => '2023-07-30 11:48:31.0000000',
                'start' => '2023-07-30 00:00:00.0000000',
                'end' => '2023-08-03 00:00:00.0000000',
                'created_at' => '2023-07-30 11:48:31.0000000',
                'updated_at' => '2023-07-30 11:48:31.0000000',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => '2',
                'description' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Bibendum est ultricies integer quis auctor elit. Mauris pharetra et ultrices neque ornare aenean euismod elementum. Pharetra diam sit amet nisl suscipit adipiscing bibendum. Ac orci phasellus egestas tellus. Risus sed vulputate odio ut enim blandit volutpat. Lacus sed turpis tincidunt id aliquet. Dolor sed viverra ipsum nunc aliquet bibendum. Dui nunc mattis enim ut tellus elementum sagittis vitae. Sit amet aliquam id diam maecenas ultricies mi. Dui id ornare arcu odio ut sem nulla. Natoque penatibus et magnis dis parturient montes nascetur ridiculus. At urna condimentum mattis pellentesque id nibh tortor. Senectus et netus et malesuada fames. Consectetur a erat nam at lectus urna duis convallis. Libero justo laoreet sit amet cursus sit amet. Elementum tempus egestas sed sed risus pretium quam. Commodo elit at imperdiet dui accumsan sit.</p><p>Tristique sollicitudin nibh sit amet commodo nulla facilisi nullam. Facilisi nullam vehicula ipsum a arcu cursus vitae. Tortor id aliquet lectus proin nibh nisl condimentum. Arcu bibendum at varius vel pharetra vel. Donec pretium vulputate sapien nec sagittis aliquam malesuada bibendum arcu. Aliquam etiam erat velit scelerisque in. Vestibulum morbi blandit cursus risus at ultrices. Convallis aenean et tortor at. Sed adipiscing diam donec adipiscing tristique risus nec. Pellentesque massa placerat duis ultricies lacus sed turpis. Quam lacus suspendisse faucibus interdum posuere lorem.</p>',
                'reference' => 'CDC-2023-02',
                'created_by_id' => '2',
                'validated_by_id' => '2',
                'validated_at' => '2023-08-17 14:01:47.6280000',
                'start' => '2023-08-17 00:00:00.0000000',
                'end' => '2023-08-25 00:00:00.0000000',
                'created_at' => '2023-08-17 14:01:47.6460000',
                'updated_at' => '2023-08-17 14:01:47.6460000',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}