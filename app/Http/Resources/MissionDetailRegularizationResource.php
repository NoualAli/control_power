<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MissionDetailRegularizationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // if (count($this->media->toArray())) {
        //     dd(array_map(fn ($item) => $item['id'], $this->media->toArray()), $this->media->toArray());
        // }
        return [
            'id' => $this->id,
            'action_to_be_taken' => $this->action_to_be_taken,
            'is_regularized' => $this->is_regularized,
            'regularized' => $this->regularized,
            'created_at' => $this->created_at,
            'media' => array_map(fn ($item) => $item['id'], $this->media->toArray())
        ];
    }
}
