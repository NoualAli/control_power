<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class MissionState extends BaseModel
{
    use HasFactory, HasUuid;

    protected $fillable = ['state'];

    /**
     * Relationships
     */
    public function mission()
    {
        return $this->belongsTo(Mission::class);
    }
}
