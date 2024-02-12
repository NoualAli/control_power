<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotificationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            $notifications = DB::table('notifications')->get();

            foreach ($notifications as $notification) {
                $originalData = json_decode($notification->data);
                $data = clone $originalData;
                if (!property_exists($data, 'short_content') && property_exists($data, 'content')) {
                    if (!is_array($data->content)) {
                        $data->short_content = '<p>' . $data->content . '</p>';
                        $data->content = strip_tags($data->content);
                    }
                    DB::table('notifications')->where('id', $notification->id)->update([
                        'data' => json_encode($data)
                    ]);
                }
            }
        });
    }
}