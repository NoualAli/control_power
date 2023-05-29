<?php

namespace App\Models;

use App\Traits\HasUuid;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Regularization extends BaseModel
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'regularized_at',
        'reason',
        'committed_action',
        'action_to_be_taken',
        'regularized_by_id',
    ];

    protected $appends = ['regularized'];

    public function getRegularizedAttribute()
    {
        return $this->regularized_at ? 'Levée' : 'Non levée';
    }

    public function getRegularizedAtAttribute($regularized_at)
    {
        return $regularized_at ? Carbon::parse($regularized_at)->format('d-m-Y') : null;
    }

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
