<?php

namespace App\Http\Resources;

use App\Models\details;
use App\Models\MissionDetail;
use Illuminate\Http\Resources\Json\JsonResource;

class MissionProcessesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $processId = $this->id;
        $details = MissionDetail::whereRelation('process', 'processes.id', $processId)->whereRelation('mission', 'missions.id', request()->mission->id);
        $totalDetails = $details->count();
        $detailsCollection = (clone $details)->get();
        $controlPoints = $detailsCollection->pluck('controlPoint');
        $data =  [
            'id' => $this->id,
            'familly' => $this->familly->name,
            'domain' => $this->domain->name,
            'name' => $this->name,
            'controlPoints' => $controlPoints,
            'control_points_count' => $controlPoints->count(),
            'progress_status' => $this->calculateProgress($detailsCollection, $totalDetails),
            'avg_score' => $this->calculateAvgScore($details),
            'executed_at' => $this->executedAt($detailsCollection, $totalDetails),
        ];
        if (isAbleTo(['process_mission', 'assign_mission_processing'])) $data['processed_at'] = $this->processedAt($detailsCollection, $totalDetails);
        return $data;
    }

    private function executedAt($details, $totalDetails)
    {
        $totalExecuted = $details->filter(fn ($detail) => $detail->executed_at !== null)->count();
        $detail = $details->first();
        return $totalDetails == $totalExecuted ? $detail?->executed_at : '-';
    }

    private function processedAt($details, $totalDetails)
    {
        $totalProcessed = $details->filter(fn ($detail) => $detail->processed_at !== null)->count();
        $detail = $details->first();
        return $totalDetails == $totalProcessed ? $detail?->processed_at : '-';
    }

    private function calculateAvgScore($details)
    {
        return addZero(intVal($details->executed()->avg('score')));
    }

    private function calculateProgress($details, $totalDetails)
    {
        $totalFinishedDetails = $details->filter(fn ($detail) => $detail->score !== null)->count();
        return number_format($totalFinishedDetails * 100 / $totalDetails);
    }
}
