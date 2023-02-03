<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MissionReport extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Relationships
     */
    public function mission()
    {
        return $this->belongsTo(Mission::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}