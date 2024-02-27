<?php

namespace App\Http\Resources;

use Carbon\Carbon;
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
            // 'registration_number' => $this->registration_number,
            'email' => $this->email ?: '-',
            'phone' => $this->phone ?: '-',
            'dres' => $this->dres_str ?: '-',
            'role' => $this->role,
            'is_active' => $this->is_active,
            'role_code' => $this->code,
            'last_login' => $this->last_activity ? Carbon::parse($this->last_activity)->format('d-m-Y H:i') : '-',
            'created_at' => Carbon::parse($this->created_at)->format('d-m-Y'),
            'must_change_password' => boolval($this->must_change_password),
        ];
    }
}
