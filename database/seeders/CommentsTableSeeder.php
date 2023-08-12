<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('comments')->delete();
        
        \DB::table('comments')->insert(array (
            0 => 
            array (
                'id' => '3d0b1c5f-08be-4472-9958-4cd64766f006',
                'content' => '<p class="ql-align-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam venenatis urna dapibus mi euismod, in sodales nulla cursus. Nullam quis luctus eros. Nulla efficitur tortor et odio lobortis mattis. Morbi iaculis, dolor eget volutpat volutpat, felis nisl consequat nibh, in pellentesque dolor nibh eu dui. Sed vehicula dictum lorem, a finibus sem ultricies non. Donec iaculis tincidunt arcu quis mollis. Sed sit amet semper risus. In sit amet lacus elit. Nulla rutrum condimentum velit vel ornare.</p><p class="ql-align-justify">Mauris nec tellus quam. Nunc congue id lectus id ultrices. Vestibulum vestibulum ante risus, in rutrum leo hendrerit in. Etiam ipsum purus, accumsan a sem nec, bibendum aliquet felis. Nunc lobortis tempor ligula, in facilisis dui. Curabitur in velit massa. Etiam vehicula pharetra finibus. Donec eu elementum tortor, in sodales mi.</p><p class="ql-align-justify">Quisque tempor pulvinar aliquet. Cras nisl lacus, fringilla vel fringilla et, maximus sed felis. Pellentesque et dignissim elit. In venenatis lacus a dui tempor consectetur. Suspendisse pharetra eleifend elit, id laoreet eros tincidunt eget. Donec volutpat orci auctor mi scelerisque, commodo mattis libero venenatis. Aenean sed mauris et sapien commodo fermentum. Vestibulum sit amet orci non ante scelerisque ornare sed sed nunc. Sed scelerisque viverra scelerisque. Ut convallis sollicitudin ornare. Fusce a libero eget eros fermentum porta. Nam a odio purus. Ut eu laoreet quam.</p>',
                'type' => 'ci_report',
                'commentable_type' => 'App\\Models\\Mission',
                'commentable_id' => 'a515650d-1702-4236-a439-4944783ac815',
                'created_by_id' => 45,
                'created_at' => '2023-08-02 20:53:06',
                'updated_at' => '2023-08-02 20:53:06',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => '5a38cf77-bf9d-4537-86e7-360a2e6617a9',
                'content' => '<p class="ql-align-justify">Phasellus convallis, leo a tristique ultrices, dui lacus fermentum turpis, ac posuere massa magna et est. Aenean laoreet neque sed tortor consequat, et vestibulum eros pellentesque. Nulla molestie vel quam non feugiat. Mauris rutrum pulvinar scelerisque. Ut blandit nulla eget nisi pellentesque sodales. Vestibulum quis nibh ultrices, tempor nunc eget, tempor lacus. Donec luctus id velit vitae dignissim. Integer pulvinar sem et augue scelerisque euismod. Sed gravida lorem mi, id ullamcorper ante fermentum sed. Curabitur at urna diam. Quisque in velit eu nisi dapibus semper sit amet eu arcu. Vivamus efficitur tortor vel diam placerat suscipit.</p><p class="ql-align-justify">Nunc sed odio quis mi imperdiet rhoncus eu quis dolor. Phasellus neque enim, consequat sit amet sapien a, laoreet gravida ante. Mauris nec orci facilisis, vulputate metus ac, molestie magna. Sed dictum arcu eu eleifend aliquam. Mauris semper erat et fermentum porttitor. Curabitur suscipit, mauris eu tincidunt tristique, nunc odio condimentum felis, nec elementum arcu justo vestibulum urna. Donec in pulvinar nunc. Curabitur vel convallis metus. In dui metus, pellentesque eu sapien et, tincidunt porttitor mauris. Vestibulum mollis ante lectus, eu efficitur augue elementum in. Nam commodo augue nec iaculis aliquet. Morbi facilisis, felis a tempor porttitor, lacus erat consequat tellus, vitae ullamcorper turpis nibh in eros. Vestibulum ut cursus metus, et vestibulum libero. Pellentesque felis ante, ultricies sed rhoncus a, varius luctus purus. Nulla facilisi. Donec cursus volutpat nisl.</p>',
                'type' => 'cdc_report',
                'commentable_type' => 'App\\Models\\Mission',
                'commentable_id' => 'a515650d-1702-4236-a439-4944783ac815',
                'created_by_id' => 44,
                'created_at' => '2023-08-02 20:53:58',
                'updated_at' => '2023-08-02 20:53:58',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}