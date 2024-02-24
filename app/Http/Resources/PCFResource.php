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
            'original_name' => $this->original_name,
            'path' => env('APP_URL') . '/storage/' . $this->folder . '/' . $this->hash_name,
            'size' => formatBytes($this->size),
            'category' => $this->category,
            'relationship_count' => $this->relationship_count,
        ];
    }
}