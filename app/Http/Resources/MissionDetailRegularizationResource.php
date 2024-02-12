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
        return [
            'id' => $this->id,
            'action_to_be_taken' => $this->action_to_be_taken,
            'is_regularized' => $this->is_regularized,
            'regularized' => $this->regularized,
            'created_at' => $this->created_at,
            'rejected_at' => $this->rejected_at,
            'is_rejected' => $this->is_rejected,
            'rejected_by_full_name' => $this->rejected_by_full_name,
            'regularization_comment' => $this->regularization_comment,
            'media' => array_map(fn ($item) => $item['id'], $this->media->toArray())
        ];
    }
}