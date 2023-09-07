<?php

namespace Database\Seeders;

use App\Imports\ControlPointsImport;
use App\Models\Agency;
use App\Models\ControlCampaign;
use App\Models\Dre;
use App\Models\Mission;
use App\Models\Process;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Excel::import(new ControlPointsImport, public_path('pcf.xlsx'));

        if (env('DB_CONNECTION') == 'mysql') {
            $this->call(UsersTableSeeder::class);
        } else {
            DB::unprepared('SET IDENTITY_INSERT users ON');
            $this->call(UsersTableSeeder::class);
            DB::unprepared('SET IDENTITY_INSERT users OFF');
        }

        if (env('DB_CONNECTION') == 'mysql') {
            $this->call(RolesTableSeeder::class);
        } else {
            DB::unprepared('SET IDENTITY_INSERT roles ON');
            $this->call(RolesTableSeeder::class);
            DB::unprepared('SET IDENTITY_INSERT roles OFF');
        }

        if (env('DB_CONNECTION') == 'mysql') {
            $this->call(PermissionsTableSeeder::class);
        } else {
            DB::unprepared('SET IDENTITY_INSERT permissions ON');
            $this->call(PermissionsTableSeeder::class);
            DB::unprepared('SET IDENTITY_INSERT permissions OFF');
        }

        $this->call(RoleHasPermissionsTableSeeder::class);
        $this->call(UserHasRolesTableSeeder::class);

        if (env('DB_CONNECTION') == 'mysql') {
            $this->call(DresTableSeeder::class);
        } else {
            DB::unprepared('SET IDENTITY_INSERT dres ON');
            $this->call(DresTableSeeder::class);
            DB::unprepared('SET IDENTITY_INSERT dres OFF');
        }

        if (env('DB_CONNECTION') == 'mysql') {
            $this->call(CategoriesTableSeeder::class);
        } else {
            DB::unprepared('SET IDENTITY_INSERT categories ON');
            $this->call(CategoriesTableSeeder::class);
            DB::unprepared('SET IDENTITY_INSERT categories OFF');
        }

        $this->call(CategoryHasProcessesTableSeeder::class);

        if (env('DB_CONNECTION') == 'mysql') {
            $this->call(AgenciesTableSeeder::class);
        } else {
            DB::unprepared('SET IDENTITY_INSERT agencies ON');
            $this->call(AgenciesTableSeeder::class);
            DB::unprepared('SET IDENTITY_INSERT agencies OFF');
        }

        $this->call(UserHasAgenciesTableSeeder::class);

        if (env('DB_CONNECTION') == 'mysql') {
            $this->call(ControlCampaignsTableSeeder::class);
            $this->call(ControlCampaignProcessesTableSeeder::class);
            // $this->call(MissionsTableSeeder::class);
            // $this->call(MissionDetailsTableSeeder::class);
            // $this->call(MediaTableSeeder::class);
            // $this->call(MissionDetailRegularizationsTableSeeder::class);
        } else {
            DB::unprepared('SET IDENTITY_INSERT control_campaigns ON');
            // $this->call(ControlCampaignsTableSeeder::class);
            DB::unprepared('SET IDENTITY_INSERT control_campaigns OFF');

            // $this->call(MissionsTableSeeder::class);
            // $this->call(MissionDetailsTableSeeder::class);
            // $this->call(ControlCampaignProcessesTableSeeder::class);
            // $this->call(MediaTableSeeder::class);

            // DB::unprepared('SET IDENTITY_INSERT mission_detail_regularizations ON');
            // $this->call(MissionDetailRegularizationsTableSeeder::class);
            // DB::unprepared('SET IDENTITY_INSERT mission_detail_regularizations OFF');
        }
        $this->call(MediaTableSeeder::class);
        // $this->call(MissionHasControllersTableSeeder::class);
        // $this->call(CommentsTableSeeder::class);
        $this->generateFakeMissions();
    }

    private function generateFakeMissions()
    {
        try {
            $campaign = ControlCampaign::findOrFail(1);
            // $agencies = Agency::all();
            $dres = Dre::all();

            foreach ($dres as $dre) {
                $i = 0;
                $agencies = $dre->agencies;
                foreach ($agencies as $agency) {
                    // $dre = $agency->dre;
                    $createdById = User::whereRoles(['CDC'])->whereRelation('dres', 'dres.id', '=', $dre->id)->first()->id;
                    $controlCampginId = $campaign->id;
                    $agencyId = $agency->id;
                    $note = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris eu convallis metus. Proin semper libero sed lectus efficitur, non elementum nisl tempus. Curabitur semper eros vitae sem elementum, in eleifend justo consequat. Suspendisse consequat nulla massa, ullamcorper porttitor nisl semper ac';
                    $mission = Mission::create([
                        'reference' => 'RAP' . str_replace('-', '', str_replace('CDC-', '', $campaign->reference)) . '/' . $agency->code,
                        'created_by_id' => $createdById,
                        'control_campaign_id' => $controlCampginId,
                        'agency_id' => $agencyId,
                        'note' => $note,
                        'programmed_start' => $campaign->getAttributes()['start'],
                        'programmed_end' => $campaign->getAttributes()['end'],
                    ]);
                    $controllerId = User::whereRoles(['CI'])->whereRelation('dres', 'dres.id', '=', $dre->id)->first()->id;
                    $controlPoints = $this->loadControlPoints($campaign, $agency);
                    $mission->dreControllers()->attach($controllerId);
                    $mission->details()->createMany($controlPoints);
                    $this->updateDetails($mission);
                    $i += 1;
                    if ($i > 1) {
                        break;
                    }
                }
            }
        } catch (\Throwable $th) {
            dd($th->getMessage(), $th->getLine());
        }
    }

    private function loadControlPoints(ControlCampaign $campaign, Agency $agency): array
    {
        $agency->load(['unusableProcesses', 'usableProcesses']);

        $campaignProcesses = $campaign->processes;
        $categoryProcesses = [];
        if ($campaignProcesses->count()) {
            $categoryProcesses = $agency->category->processes;
            $exceptionalUsableAgencyProcesses = $agency->usableProcesses;
            $exceptionalUnusableAgencyProcesses = $agency->unusableProcesses->pluck('id')->toArray();

            $categoryProcesses = $categoryProcesses->merge($exceptionalUsableAgencyProcesses)->unique('id'); // Ajout des processus exceptionelles

            $categoryProcesses = $categoryProcesses->filter(function ($process) use ($exceptionalUnusableAgencyProcesses) {
                return !in_array($process->id, $exceptionalUnusableAgencyProcesses); // suppression des processus exceptionelles
            });

            $categoryProcesses = $categoryProcesses->pluck('id')->toArray();
        }
        return $campaignProcesses->filter(function ($process) use ($categoryProcesses) {
            return in_array($process->id, $categoryProcesses); // garder que les processus utilisés par la catégorie
        })->pluck('control_points')->flatten()->pluck('id')->map(fn ($controlPoint) => ['control_point_id' => $controlPoint])->toArray();
    }

    private function updateDetails(Mission $mission)
    {
        foreach ($mission->details as $detail) {
            $majorFact = $this->generateMajorFact($detail->controlPoint->has_major_fact);
            $score = $majorFact ?  $detail->controlPoint->scores_arr_num[count($detail->controlPoint->scores_arr_num) - 1] : $this->generateScore($detail->controlPoint->scores_arr_num);
            $ciReport = $score > 1 ? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris eu convallis metus. Proin semper libero sed lectus efficitur, non elementum nisl tempus. Curabitur semper eros vitae sem elementum, in eleifend justo consequat.' : null;
            $recoveryPlan = $score > 1 ? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris eu convallis metus. Proin semper libero sed lectus efficitur, non elementum nisl tempus. Curabitur semper eros vitae sem elementum, in eleifend justo consequat.' : null;
            $detail->update([
                'controlled_by_ci_id' => $mission->controllers()->first()->id,
                'controlled_by_ci_at' => today(),
                'controlled_by_cdc_id' => $mission->creator->id,
                'controlled_by_cdc_at' => today(),
                'ci_report' => $ciReport,
                'recovery_plan' => $recoveryPlan,
                'score' => $score,
                'major_fact' => $majorFact,
            ]);
        }
        $mission->update([
            'ci_validation_at' => now(),
            'ci_validation_by_id' => $mission->controllers()->first()->id,

            'cdc_validation_at' => now(),
            'cdc_validation_by_id' => $mission->creator->id,

            'cdcr_validation_at' => now(),
            'cdcr_validation_by_id' => User::whereRoles(['cdcr'])->first()->id,

            'dcp_validation_at' => now(),
            'dcp_validation_by_id' => User::whereRoles(['dcp'])->first()->id,
        ]);
        $content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris eu convallis metus. Proin semper libero sed lectus efficitur, non elementum nisl tempus. Curabitur semper eros vitae sem elementum, in eleifend justo consequat. Suspendisse consequat nulla massa, ullamcorper porttitor nisl semper ac. Suspendisse porttitor, massa vel feugiat aliquam, leo velit consectetur nunc, et placerat augue orci eu nisl. Nullam porta nibh eros, sit amet lobortis nisl placerat a. Aliquam congue massa eros, ac rhoncus risus tempor quis. Sed dolor enim, finibus eget dolor eu, congue consequat dui. Praesent id erat sit amet enim porta pharetra. Integer cursus malesuada ligula ac sodales. Morbi vestibulum ultrices mi quis maximus. Fusce mauris elit, facilisis id tempus quis, vehicula vitae tellus. Proin ultricies consectetur finibus.

        Nullam mattis ante ultrices dapibus tincidunt. Vivamus at varius mauris, eget bibendum neque. Aenean fermentum mi scelerisque diam fermentum, sit amet scelerisque purus interdum. Maecenas in porta nibh. Quisque suscipit ut mauris vitae mollis. Phasellus finibus pulvinar suscipit. In magna neque, dignissim ac sem vel, venenatis sodales mi. Vestibulum porttitor tellus diam. Aliquam id sapien tempor, congue mi at, finibus purus. Duis gravida nulla nec sodales vehicula. Sed sed sem sem. Nunc sed erat posuere, scelerisque justo non, hendrerit diam. Integer vel mi varius, lacinia metus quis, feugiat ante.

        Nunc hendrerit consequat tortor quis vehicula. Etiam placerat, elit nec viverra tempor, turpis nunc tempus nulla, sit amet congue erat mi pharetra mi. Nam eu ullamcorper leo. In eu quam mauris. Vestibulum rhoncus nibh et sapien consectetur, in condimentum ante blandit. Nullam risus sapien, hendrerit aliquam scelerisque ac, ultrices ac elit. Fusce posuere nisi et sapien sagittis iaculis. Sed euismod orci ante, eget molestie justo suscipit vitae. Mauris commodo urna leo, vel accumsan dolor mollis sit amet. Nulla nec velit nec dolor porta fringilla. Vestibulum suscipit hendrerit ultrices. Nullam ligula odio, pharetra in cursus eu, convallis eu felis. Sed eleifend faucibus massa vel blandit. Sed sit amet mi consequat, vehicula odio tincidunt, dapibus ante. Integer eget tortor vitae quam auctor gravida in eu orci. Mauris tincidunt suscipit sem, vel volutpat augue pretium vitae.';
        $comment = $mission->comments()->create([
            'content' => $content,
            'type' => 'ci_report',
            'created_by_id' => $mission->ciValidator->id,
        ]);
        $comment = $mission->comments()->create([
            'content' => $content,
            'type' => 'cdc_report',
            'created_by_id' => $mission->cdcValidator->id,
        ]);
    }

    private function generateScore(array $scores)
    {
        $probabilities = [
            1 => 0.5, // 40% de probabilité pour le score 1
            2 => 0.40, // 30% de probabilité pour le score 2
            3 => 0.10, // 10% de probabilité pour le score 3
            4 => 0.10, // 10% de probabilité pour le score 4
        ];

        // Générez un nombre aléatoire entre 0 et 1
        $randomNumber = mt_rand() / mt_getrandmax();

        // Initialisez la probabilité totale à 0
        $totalProbability = 0;

        $selectedScore = 1;

        // Parcourez les probabilités pour choisir un score
        foreach ($probabilities as $score => $probability) {
            $totalProbability += $probability;

            if ($randomNumber <= $totalProbability) {
                if (!in_array($randomNumber, $scores)) {
                    $selectedScore = $score;
                    break;
                }
            }
        }
        return $selectedScore;
    }

    private function generateMajorFact(bool $hasMajorFact = false)
    {
        if ($hasMajorFact) {
            $probabilities = [
                1 => 0.01, // 2% de probabilité pour le true
                2 => 0.99, // 98% de probabilité pour le false
            ];

            // Générez un nombre aléatoire entre 0 et 1
            $randomNumber = mt_rand() / mt_getrandmax();

            // Initialisez la probabilité totale à 0
            $totalProbability = 0;

            $isMajorFact = false;

            // Parcourez les probabilités pour choisir un score
            foreach ($probabilities as $majorFact => $probability) {
                $totalProbability += $probability;

                if ($randomNumber <= $totalProbability) {
                    $isMajorFact = $majorFact;
                    break;
                }
            }

            return $isMajorFact == 1 ? true : false;
        }
        return false;
    }
}
