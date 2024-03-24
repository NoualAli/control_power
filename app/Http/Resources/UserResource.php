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
        // dd($this->last_login->last_activity);
        return [
            'id' => $this->id,
            'username' => $this->username,
            'full_name' => $this->full_name,
            // 'registration_number' => $this->registration_number,
            'email' => $this->email ?: '-',
            'phone' => $this->phone ?: '-',
            'structures' => $this->getStructures(),
            'role' => $this->role->name,
            'is_active' => $this->is_active,
            'role_code' => $this->role->code,
            'last_login' => $this->last_login ? $this->last_login->last_activity : '-',
            'created_at' => Carbon::parse($this->created_at)->format('d-m-Y'),
            'must_change_password' => boolval($this->must_change_password),
        ];
    }

    private function getStructures()
    {
        if (hasRole(['ci', 'cdc', 'dre'], $this->role->code)) {
            return $this->dres_str;
        } elseif (hasRole('da', $this->role->code)) {
            return $this->agencies_str;
        } elseif (hasRole('ir', $this->role->code)) {
            return $this->regional_inspections_str;
        } else {
            return '-';
        }
    }
}
