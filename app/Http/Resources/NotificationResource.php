<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $createdAt = $this->created_at ? Carbon::parse($this->created_at)->diffForHumans() : '-';
        $readAt = $this->read_at ? Carbon::parse($this->read_at)->diffForHumans() : '-';
        return [
            'id' => $this->id,
            'content' => $this->data['content'],
            'title' => $this->data['title'],
            'created_at' => $createdAt,
            'read_at' => $readAt,
        ];
    }
}
