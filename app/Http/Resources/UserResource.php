<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'username' => $this->username,
            'full_name' => $this->full_name,
            'registration_number' => $this->registration_number,
            'email' => $this->email,
            'role' => $this->role->name,
            'dres' => $this->dres_str,
            'is_active' => $this->is_active,
            'role_code' => $this->role->code,
        ];
    }
}
