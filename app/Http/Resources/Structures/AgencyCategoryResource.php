<?php

namespace App\Http\Resources\Structures;

use Illuminate\Http\Resources\Json\JsonResource;

class AgencyCategoryResource extends JsonResource
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
            'name' =>  $this->name,
            'processes_count' => $this->processes_count
        ];
    }
}
