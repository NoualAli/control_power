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

        \DB::table('comments')->insert(array(
            0 =>
            array(
                'id' => '3D0B1C5F-08BE-4472-9958-4CD64766F006',
                'content' => '<p class="ql-align-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam venenatis urna dapibus mi euismod, in sodales nulla cursus. Nullam quis luctus eros. Nulla efficitur tortor et odio lobortis mattis. Morbi iaculis, dolor eget volutpat volutpat, felis nisl consequat nibh, in pellentesque dolor nibh eu dui. Sed vehicula dictum lorem, a finibus sem ultricies non. Donec iaculis tincidunt arcu quis mollis. Sed sit amet semper risus. In sit amet lacus elit. Nulla rutrum condimentum velit vel ornare.</p><p class="ql-align-justify">Mauris nec tellus quam. Nunc congue id lectus id ultrices. Vestibulum vestibulum ante risus, in rutrum leo hendrerit in. Etiam ipsum purus, accumsan a sem nec, bibendum aliquet felis. Nunc lobortis tempor ligula, in facilisis dui. Curabitur in velit massa. Etiam vehicula pharetra finibus. Donec eu elementum tortor, in sodales mi.</p><p class="ql-align-justify">Quisque tempor pulvinar aliquet. Cras nisl lacus, fringilla vel fringilla et, maximus sed felis. Pellentesque et dignissim elit. In venenatis lacus a dui tempor consectetur. Suspendisse pharetra eleifend elit, id laoreet eros tincidunt eget. Donec volutpat orci auctor mi scelerisque, commodo mattis libero venenatis. Aenean sed mauris et sapien commodo fermentum. Vestibulum sit amet orci non ante scelerisque ornare sed sed nunc. Sed scelerisque viverra scelerisque. Ut convallis sollicitudin ornare. Fusce a libero eget eros fermentum porta. Nam a odio purus. Ut eu laoreet quam.</p>',
                'type' => 'ci_report',
                'commentable_type' => 'App\\Models\\Mission',
                'commentable_id' => 'a515650d-1702-4236-a439-4944783ac815',
                'created_by_id' => '45',
                'created_at' => '2023-08-02 20:53:06.0000000',
                'updated_at' => '2023-08-02 20:53:06.0000000',
                'deleted_at' => NULL,
            ),
            1 =>
            array(
                'id' => '5A38CF77-BF9D-4537-86E7-360A2E6617A9',
                'content' => '<p class="ql-align-justify">Phasellus convallis, leo a tristique ultrices, dui lacus fermentum turpis, ac posuere massa magna et est. Aenean laoreet neque sed tortor consequat, et vestibulum eros pellentesque. Nulla molestie vel quam non feugiat. Mauris rutrum pulvinar scelerisque. Ut blandit nulla eget nisi pellentesque sodales. Vestibulum quis nibh ultrices, tempor nunc eget, tempor lacus. Donec luctus id velit vitae dignissim. Integer pulvinar sem et augue scelerisque euismod. Sed gravida lorem mi, id ullamcorper ante fermentum sed. Curabitur at urna diam. Quisque in velit eu nisi dapibus semper sit amet eu arcu. Vivamus efficitur tortor vel diam placerat suscipit.</p><p class="ql-align-justify">Nunc sed odio quis mi imperdiet rhoncus eu quis dolor. Phasellus neque enim, consequat sit amet sapien a, laoreet gravida ante. Mauris nec orci facilisis, vulputate metus ac, molestie magna. Sed dictum arcu eu eleifend aliquam. Mauris semper erat et fermentum porttitor. Curabitur suscipit, mauris eu tincidunt tristique, nunc odio condimentum felis, nec elementum arcu justo vestibulum urna. Donec in pulvinar nunc. Curabitur vel convallis metus. In dui metus, pellentesque eu sapien et, tincidunt porttitor mauris. Vestibulum mollis ante lectus, eu efficitur augue elementum in. Nam commodo augue nec iaculis aliquet. Morbi facilisis, felis a tempor porttitor, lacus erat consequat tellus, vitae ullamcorper turpis nibh in eros. Vestibulum ut cursus metus, et vestibulum libero. Pellentesque felis ante, ultricies sed rhoncus a, varius luctus purus. Nulla facilisi. Donec cursus volutpat nisl.</p>',
                'type' => 'cdc_report',
                'commentable_type' => 'App\\Models\\Mission',
                'commentable_id' => 'a515650d-1702-4236-a439-4944783ac815',
                'created_by_id' => '44',
                'created_at' => '2023-08-02 20:53:58.0000000',
                'updated_at' => '2023-08-02 20:53:58.0000000',
                'deleted_at' => NULL,
            ),
            2 =>
            array(
                'id' => 'C5AE92D8-E609-4642-9A6D-ACCB1F1F195C',
                'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce auctor, sapien non ultricies ullamcorper, libero libero volutpat elit, a lacinia velit nisl ut ex. Integer sagittis sapien nec lectus iaculis, sed volutpat odio fringilla. Sed auctor ex vel sapien tristique, nec commodo quam volutpat. Nullam pellentesque ullamcorper ipsum nec bibendum. Vivamus et libero vitae nisl varius varius. Nunc sed velit sed quam interdum facilisis. Cras vel nunc sed massa pulvinar sollicitudin vel sit amet erat. Nullam id arcu vel quam sagittis fringilla in ut libero. Suspendisse malesuada, risus in dictum venenatis, ligula ante bibendum massa, in vestibulum odio enim non ante. Sed nec dictum libero</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce auctor, sapien non ultricies ullamcorper, libero libero volutpat elit, a lacinia velit nisl ut ex. Integer sagittis sapien nec lectus iaculis, sed volutpat odio fringilla. Sed auctor ex vel sapien tristique, nec commodo quam volutpat. Nullam pellentesque ullamcorper ipsum nec bibendum. Vivamus et libero vitae nisl varius varius. Nunc sed velit sed quam interdum facilisis. Cras vel nunc sed massa pulvinar sollicitudin vel sit amet erat. Nullam id arcu vel quam sagittis fringilla in ut libero. Suspendisse malesuada, risus in dictum venenatis, ligula ante bibendum massa, in vestibulum odio enim non ante. Sed nec dictum libero</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce auctor, sapien non ultricies ullamcorper, libero libero volutpat elit, a lacinia velit nisl ut ex. Integer sagittis sapien nec lectus iaculis, sed volutpat odio fringilla. Sed auctor ex vel sapien tristique, nec commodo quam volutpat. Nullam pellentesque ullamcorper ipsum nec bibendum. Vivamus et libero vitae nisl varius varius. Nunc sed velit sed quam interdum facilisis. Cras vel nunc sed massa pulvinar sollicitudin vel sit amet erat. Nullam id arcu vel quam sagittis fringilla in ut libero. Suspendisse malesuada, risus in dictum venenatis, ligula ante bibendum massa, in vestibulum odio enim non ante. Sed nec dictum libero</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce auctor, sapien non ultricies ullamcorper, libero libero volutpat elit, a lacinia velit nisl ut ex. Integer sagittis sapien nec lectus iaculis, sed volutpat odio fringilla. Sed auctor ex vel sapien tristique, nec commodo quam volutpat. Nullam pellentesque ullamcorper ipsum nec bibendum. Vivamus et libero vitae nisl varius varius. Nunc sed velit sed quam interdum facilisis. Cras vel nunc sed massa pulvinar sollicitudin vel sit amet erat. Nullam id arcu vel quam sagittis fringilla in ut libero. Suspendisse malesuada, risus in dictum venenatis, ligula ante bibendum massa, in vestibulum odio enim non ante. Sed nec dictum libero</p>',
                'type' => 'ci_report',
                'commentable_type' => 'App\\Models\\Mission',
                'commentable_id' => 'FA60045C-C4FD-457F-905E-5DB6D5260066',
                'created_by_id' => '45',
                'created_at' => '2023-08-17 20:10:56.2270000',
                'updated_at' => '2023-08-17 20:10:56.2270000',
                'deleted_at' => NULL,
            ),
            3 =>
            array(
                'id' => '6DCDD218-2F50-4A19-804D-5120EA8FD02D',
                'content' => '<p>In the quiet forest, a mischievous squirrel named Oliver embarked on a daring adventure. Armed with a shiny acorn helmet and a determined spirit, he set out to uncover the secrets of the Enchanted Clearing. The air was thick with anticipation as Oliver hopped from tree to tree, his bushy tail flicking with excitement. Along the way, he encountered a wise old owl who offered cryptic riddles, a giggling stream that whispered ancient lullabies, and a field of glowing mushrooms that illuminated his path.</p><p>As the sun dipped below the horizon, Oliver finally reached the heart of the Enchanted Clearing. There, he discovered a shimmering pool that reflected the stars above. The water seemed to hold whispers of forgotten tales, and as Oliver peered into its depths, he saw glimpses of his own dreams and desires. With newfound understanding, he realized that the Enchanted Clearing was a place of self-discovery, a realm where one could find the answers they sought within themselves.</p><p>With a contented heart, Oliver donned his acorn helmet once more and made his way back through the forest. As he returned home, he carried not just the memory of his adventure, but also a deeper connection to his own hopes and aspirations. And so, the mischievous squirrel\'s tale became a legend shared among the forest creatures, a reminder that sometimes the greatest journey is the one that leads us to ourselves.</p><p>In the quiet forest, a mischievous squirrel named Oliver embarked on a daring adventure. Armed with a shiny acorn helmet and a determined spirit, he set out to uncover the secrets of the Enchanted Clearing. The air was thick with anticipation as Oliver hopped from tree to tree, his bushy tail flicking with excitement. Along the way, he encountered a wise old owl who offered cryptic riddles, a giggling stream that whispered ancient lullabies, and a field of glowing mushrooms that illuminated his path.</p><p>As the sun dipped below the horizon, Oliver finally reached the heart of the Enchanted Clearing. There, he discovered a shimmering pool that reflected the stars above. The water seemed to hold whispers of forgotten tales, and as Oliver peered into its depths, he saw glimpses of his own dreams and desires. With newfound understanding, he realized that the Enchanted Clearing was a place of self-discovery, a realm where one could find the answers they sought within themselves.</p><p>With a contented heart, Oliver donned his acorn helmet once more and made his way back through the forest. As he returned home, he carried not just the memory of his adventure, but also a deeper connection to his own hopes and aspirations. And so, the mischievous squirrel\'s tale became a legend shared among the forest creatures, a reminder that sometimes the greatest journey is the one that leads us to ourselves.</p>',
                'type' => 'cdc_report',
                'commentable_type' => 'App\\Models\\Mission',
                'commentable_id' => 'FA60045C-C4FD-457F-905E-5DB6D5260066',
                'created_by_id' => '44',
                'created_at' => '2023-08-17 20:13:15.0130000',
                'updated_at' => '2023-08-17 20:13:15.0130000',
                'deleted_at' => NULL,
            ),
        ));
    }
}
