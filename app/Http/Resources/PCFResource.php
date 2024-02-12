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
            'id' => $this->id,
            'family' => $this->family,
            'domain' => $this->domain,
            'process' => $this->process,
            // 'media' => $this->media
        ];
    }
}
