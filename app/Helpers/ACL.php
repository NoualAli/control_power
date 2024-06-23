<?php

use App\Enums\MissionState;
use App\Models\Mission;
use App\Models\Process;
use App\Models\User;
use Illuminate\Support\Facades\DB;

if (!function_exists('canAccessMission')) {
    function canAccessMission(Mission $mission, ?User $user = null)
    {
        isAbleOrAbort('view_mission');
        $currentUser = $user ?: auth()->user();

        $dreController = $mission->dreController->id;
        $dreAssistants = $mission->assistants->pluck('id')->toArray();
        $dcpController = $mission->assigned_to_cc_id;
        $agencies = $currentUser->agencies->pluck('id')->toArray();

        $canAccessMission =
            (request()->has('edit') && $mission->current_state == MissionState::TODO && hasRole('cdc') && $mission->created_by_id == $currentUser->id)
            || (hasRole('ci') && $currentUser->id == $dreController)
            || hasRole('ci') && in_array($currentUser->id, $dreAssistants)
            || hasRole('cc') && $currentUser->id == $dcpController
            || $mission->created_by_id == $currentUser->id
            || ($mission->assigned_to_cder_id == $currentUser->id && hasRole('cder'))
            || (hasRole(['cdcr', 'dcp']) && $mission->is_validated_by_cdc)
            || (hasRole(['dg', 'cdrcp', 'ig', 'iga', 'der', 'sg', 'deac', 'dga']) && $mission->is_validated_by_dcp)
            || (hasRole(['dre', 'da', 'ir']) && in_array($mission->agency->id, $agencies) && $mission->is_validated_by_dcp)
            || hasRole(['root', 'admin']);

        abort_if(!$canAccessMission, FORBIDDEN, __('unauthorized'));
    }
}


if (!function_exists('canAccessMissionDetail')) {
    function canAccessMissionDetail(Mission $mission, Process $process, ?User $user = null)
    {
        isAbleOrAbort(['view_mission', 'control_agency']);
        $currentUser = $user ?: auth()->user();

        $dreController = $mission->dreController->id;
        $dreAssistants = $mission->assistants->pluck('id')->toArray();
        $dcpController = $mission->assigned_to_cc_id;
        $agencies = $currentUser->agencies->pluck('id')->toArray();

        $canAccessMission =
            hasRole('ci') && $currentUser->id == $dreController
            || hasRole('ci') && in_array($currentUser->id, $dreAssistants)
            || hasRole('cc') && $currentUser->id == $dcpController
            || $mission->created_by_id == $currentUser->id
            || ($mission->assigned_to_cder_id == $currentUser->id && hasRole('cder'))
            || (hasRole(['cdcr', 'dcp']) && $mission->is_validated_by_cdc)
            || (hasRole(['dg', 'cdrcp', 'ig', 'iga', 'der', 'sg', 'deac', 'dga']) && $mission->is_validated_by_dcp)
            || (hasRole(['dre', 'da', 'ir']) && in_array($mission->agency->id, $agencies) && $mission->is_validated_by_dcp)
            || hasRole(['root', 'admin']);

        abort_if(!$canAccessMission, FORBIDDEN, __('unauthorized'));

        $process = getProcesses($process->id);
        $process->media = getMedia()->where('attachable_id', $process->id)->where('attachable_type', Process::class)->get();
        $checkProcessIfDisabled = DB::table('mission_details AS md')->select(DB::raw('CASE WHEN SUM(CASE WHEN md.is_disabled = 1 THEN 1 ELSE 0 END) > 0 THEN (SUM(CASE WHEN md.is_disabled = 1 THEN 1 ELSE 0 END) / COUNT(md.id)) * 100 ELSE 0 END AS disabled_rate'))
            ->leftJoin('control_points AS cp', 'cp.id', 'md.control_point_id')
            ->leftJoin('processes AS p', 'p.id', 'cp.process_id')
            ->where('md.mission_id', $mission->id)->where('p.id', $process->id)->first();
        $checkProcess = intval($checkProcessIfDisabled->disabled_rate) == 100;

        abort_if($checkProcess, LOCKED, "Le processus $process->name est vérouillez");
    }
}
