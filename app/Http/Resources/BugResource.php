<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class BugResource extends JsonResource
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
            'reference' => $this->reference,
            'type' => $this->type,
            'creator' => $this->creator,
            'priority_html' => $this->priority_html,
            'created_at' => Carbon::parse($this->created_at)->diffForHumans(),
            'state' => hasRole('root') ? $this->fixed_at : $this->is_fixed
        ];
    }
}
