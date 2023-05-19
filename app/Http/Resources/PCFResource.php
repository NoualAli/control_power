<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PCFResource extends JsonResource
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
            'row_number' => $this->row_number,
            'familly_name' => $this->familly->name,
            'domain_name' => $this->domain->name,
            'process_name' => $this->process->name,
            'control_point_name' => $this->name,
        ];
    }
}
