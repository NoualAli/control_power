<?php

namespace Database\Seeders;

use App\Models\Mission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            $missions = getMissions()->get();
            $results = collect([]);
            foreach ($missions as $mission) {
                $missionFirstDetailControlled = getMissionDetails($mission->id)->select(['controlled_by_ci_at'])->orderBy('controlled_by_ci_at')->first()?->controlled_by_ci_at;
                $result = DB::table('missions')->where('id', $mission->id)->update([
                    'real_start' => $missionFirstDetailControlled,
                    'real_end' => $mission->end_date
                ]);

                $results->push(['reference' => $mission->reference, 'status' => $result]);
            }
            if ($results->contains('status', 0)) {
                dd($results->pluck('reference')->join(', '));
            }
        });
    }
}
