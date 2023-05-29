<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ControlPointResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'familly_name' => $this->familly->name,
            'domain_name' => $this->domain->name,
            'process_name' => $this->process->name,
            'major_fact' => $this->major_fact_str,
            'scores_str' => $this->scores_str
        ];
    }
}
