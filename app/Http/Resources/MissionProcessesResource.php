<?php

namespace App\Http\Resources;

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
        $missionDetail = MissionDetail::whereRelation('process', 'processes.id', $processId)->whereRelation('mission', 'missions.id', request()->mission->id);
        return [
            'id' => $this->id,
            'familly' => $this->familly->name,
            'domain' => $this->domain->name,
            'name' => $this->name,
            'controlPoints' => $this->control_points,
            'control_points_count' => $this->control_points_count,
            'progress_status' => $this->calculateProgress($missionDetail),
            'avg_score' => $this->calculateAvgScore($missionDetail),
        ];
    }

    private function calculateAvgScore($details)
    {
        return addZero(intVal($details->executed()->avg('score')));
    }

    private function calculateProgress($details)
    {
        $totalDetails = $details->count();
        $totalFinishedDetails = $details->get()->filter(fn ($detail) => $detail->score !== null)->count();
        return number_format($totalFinishedDetails * 100 / $totalDetails);
    }
}
