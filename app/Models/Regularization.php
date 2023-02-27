<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regularization extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'regularized_at',
        'reason',
        'committed_action',
        'action_to_be_taken',
        'regularized_by_id',
    ];

    /**
     * Relationships
     */
    public function detail()
    {
        return $this->belongsTo(MissionDetail::class);
    }

    public function regularizator()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scopes
     */
    public function scopeOnlyUnregularized($query)
    {
        return $query->whereNull('regularized_at');
    }

    public function scopeOnlyRegularized($query)
    {
        return $query->whereNotNull('regularized_at');
    }
}
