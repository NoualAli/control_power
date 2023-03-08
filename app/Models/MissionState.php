<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MissionState extends Model
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
