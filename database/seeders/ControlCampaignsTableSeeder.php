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

        \DB::table('control_campaigns')->insert(array(
            0 =>
            array(
                'id' => 1,
                'description' => '<p><span style="background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris eu convallis metus. Proin semper libero sed lectus efficitur, non elementum nisl tempus. Curabitur semper eros vitae sem elementum, in eleifend justo consequat. Suspendisse consequat nulla massa, ullamcorper porttitor nisl semper ac. Suspendisse porttitor, massa vel feugiat aliquam, leo velit consectetur nunc, et placerat augue orci eu nisl. Nullam porta nibh eros, sit amet lobortis nisl placerat a. Aliquam congue massa eros, ac rhoncus risus tempor quis. Sed dolor enim, finibus eget dolor eu, congue consequat dui. Praesent id erat sit amet enim porta pharetra. Integer cursus malesuada ligula ac sodales. Morbi vestibulum ultrices mi quis maximus. Fusce mauris elit, facilisis id tempus quis, vehicula vitae tellus. Proin ultricies consectetur finibus.</span></p>',
                'reference' => 'CDC-2023-01',
                'created_by_id' => 4,
                'validated_by_id' => 4,
                'validated_at' => '2023-07-02 20:00:31',
                'start' => '2023-07-02 00:00:00',
                'end' => '2023-07-14 00:00:00',
                'created_at' => '2023-07-02 20:00:31',
                'updated_at' => '2023-07-02 20:00:31',
                'deleted_at' => NULL,
            ),
        ));
    }
}
