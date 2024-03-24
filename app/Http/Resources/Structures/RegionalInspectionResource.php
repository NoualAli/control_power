<?php

namespace App\Http\Resources\Structures;

use Illuminate\Http\Resources\Json\JsonResource;

class RegionalInspectionResource extends JsonResource
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
            'code' => $this->code,
            'dres_count' => $this->dres_count,
        ];
    }
}
