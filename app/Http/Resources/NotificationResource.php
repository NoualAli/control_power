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
        $content = isset($this->data['content']) ? $this->data['content'] : '-';
        $title = isset($this->data['title']) ? $this->data['title'] : '-';
        $routeName = isset($this->data['routeName']) ? $this->data['routeName'] : '-';
        $paramNames = isset($this->data['paramNames']) ? $this->data['paramNames'] : '-';
        $modelId = isset($this->data['id']) ? $this->data['id'] : '-';
        return [
            'id' => $this->id,
            'content' => $content,
            'title' => $title,
            'created_at' => $createdAt,
            'read_at' => $readAt,
            'routeName' => $routeName,
            'paramNames' => $paramNames,
            'modelId' => $modelId,
        ];
    }
}
