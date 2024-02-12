<?php

namespace Database\Seeders;

use App\Models\MissionDetail;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class MissionDetailsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            $details = DB::table('mission_details as md')->select([
                'md.id',
                'md.major_fact',
                DB::raw("cdc.id as cdc"),
                DB::raw("cdcr.id as cdcr"),
                DB::raw("dcp.id as dcp"),
                DB::raw("mde.id as mde"),
                'md.controlled_by_ci_id',
                'md.controlled_by_ci_at',
                'md.controlled_by_cdc_id',
                'md.controlled_by_cdc_at',
                'md.ci_report',
                'md.cdc_report',
                'major_fact_dispatched_at',
                'major_fact_dispatched_to_dcp_at',
                'major_fact_detected_at',
                'm.reference as mission_reference',
                'cp.id as cp_id',
                'p.id as p_id',
                'd.id as d_id',
                'f.id as f_id',
            ])
                ->leftJoin('users as cdc', 'cdc.id', 'md.controlled_by_cdc_id')
                ->leftJoin('users as cdcr', 'cdcr.id', 'md.controlled_by_cdcr_id')
                ->leftJoin('users as dcp', 'dcp.id', 'md.controlled_by_dcp_id')
                ->leftJoin('users as mde', 'mde.id', 'md.controlled_by_ci_id')
                ->leftJoin('missions as m', 'm.id', 'md.mission_id')
                ->leftJoin('control_points as cp', 'cp.id', 'md.control_point_id')
                ->leftJoin('processes as p', 'p.id', 'cp.process_id')
                ->leftJoin('domains as d', 'd.id', 'p.domain_id')
                ->leftJoin('families as f', 'f.id', 'd.family_id');

            $details = $details->groupBy(
                'md.id',
                'md.major_fact',
                'cdc.id',
                'cdcr.id',
                'dcp.id',
                'mde.id',
                'md.controlled_by_ci_id',
                'controlled_by_ci_at',
                'md.controlled_by_cdc_id',
                'md.controlled_by_cdc_at',
                'md.ci_report',
                'md.cdc_report',
                'major_fact_dispatched_at',
                'major_fact_dispatched_to_dcp_at',
                'major_fact_detected_at',
                'm.reference',
                'cp.id',
                'p.id',
                'd.id',
                'f.id',
            );

            $details = $details->get();
            foreach ($details as $detail) {
                $regularizations = DB::table('mission_detail_regularizations')->where('mission_detail_id', $detail->id)->orderBy('created_at', 'DESC')->get();
                $isRegularized = false;
                $isRejected = false;

                if ($regularizations->isNotEmpty()) {
                    $regularization = $regularizations->first();
                    $isRegularized = $regularization->is_regularized;
                    $isRejected = $regularization->is_rejected;
                }

                $missionReference = str_replace('RAP', '', str_replace('/', '-', $detail->mission_reference));
                // $controlPoint = DB::table('control_points as cp')->select(['cp.id as cp_id', 'p.id as p_id', 'd.id as d_id', 'f.id as f_id'])
                //     ->leftJoin('processes as p', 'p.id', 'cp.process_id')
                //     ->leftJoin('domains as d', 'd.id', 'p.domain_id')
                //     ->leftJoin('families as f', 'f.id', 'd.family_id')->where('cp.id', $detail->control_point_id)->first();
                $reference = $missionReference . '-' . $detail->f_id . '-' . $detail->d_id . '-' . $detail->p_id . '-' . $detail->cp_id;

                DB::table('mission_details')->where('id', $detail->id)->update([
                    'reference' => $reference,
                    'cdc_full_name' => $detail->cdc ? getUserFullNameWithRole($detail->cdc) : null,
                    'cdcr_full_name' => $detail->cdcr ? getUserFullNameWithRole($detail->cdcr) : null,
                    'dcp_full_name' => $detail->dcp ? getUserFullNameWithRole($detail->dcp) : null,
                    'major_fact_is_detected_by_full_name' => $detail->major_fact && $detail->mde ? getUserFullNameWithRole($detail->mde) : NULL,
                    'major_fact_is_detected_by_id' => $detail->major_fact ? $detail->controlled_by_ci_id : NULL,
                    'major_fact_is_detected_at' => $detail->major_fact ? $detail->controlled_by_ci_at : NULL,
                    'reg_is_regularized' => $isRegularized,
                    'reg_is_rejected' => $isRejected,
                    'major_fact_is_dispatched_at' => $detail->major_fact_dispatched_at,
                    'major_fact_is_dispatched_to_dcp_at' => $detail->major_fact_dispatched_to_dcp_at,
                    'major_fact_is_detected_at' => $detail->major_fact_detected_at,
                ]);
                if ($detail->ci_report) {
                    $id = \Illuminate\Support\Str::uuid();
                    DB::table('comments')->insert([
                        'id' => $id,
                        'type' => 'ci_observation',
                        'content' => $detail->ci_report,
                        'commentable_id' => $detail->id,
                        'commentable_type' => MissionDetail::class,
                        'created_by_id' => $detail->controlled_by_ci_id,
                        'creator_full_name' => getUserFullNameWithRole($detail->controlled_by_ci_id),
                        'created_at' => $detail->controlled_by_ci_at,
                    ]);
                }

                if ($detail->cdc_report) {
                    $id = \Illuminate\Support\Str::uuid();
                    DB::table('comments')->insert([
                        'id' => $id,
                        'type' => 'cdc_observation',
                        'content' => $detail->cdc_report,
                        'commentable_id' => $detail->id,
                        'commentable_type' => MissionDetail::class,
                        'created_by_id' => $detail->controlled_by_cdc_id,
                        'creator_full_name' => getUserFullNameWithRole($detail->controlled_by_cdc_id),
                        'created_at' => $detail->controlled_by_cdc_at,
                    ]);
                }
            }
            Schema::table('mission_details', function (Blueprint $table) {
                $table->string('reference')->unique()->change();
                $table->dropColumn('major_fact_dispatched_at');
                $table->dropColumn('major_fact_dispatched_to_dcp_at');
                $table->dropColumn('major_fact_detected_at');
                $table->dropColumn('is_regularized');
                $table->dropColumn('ci_report');
                $table->dropColumn('cdc_report');
            });
        });
    }
}
