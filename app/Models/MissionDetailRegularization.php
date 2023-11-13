<?php

namespace App\Models;

use App\Traits\HasMedia;
use App\Traits\HasUuid;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class MissionDetailRegularization extends BaseModel
{
    use HasFactory, HasUuid, HasMedia;

    protected $fillable = [
        'action_to_be_taken',
        'created_at',
        'created_by_id',
        'mission_detail_id',
        'is_regularized',
    ];

    public $timestamps = false;

    protected $appends = ['regularized', 'media_array'];

    public $casts = [
        'is_regularized' => 'boolean',
        'created_at' => 'datetime'
    ];

    public function getRegularizedAttribute()
    {
        return $this->is_regularized ? 'Levée' : 'Non levée';
    }

    public function getCreatedAtAttribute($regularized_at)
    {
        return $regularized_at ? Carbon::parse($regularized_at)->format('d-m-Y H:i') : null;
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
        return $query->where('is_regularized', false);
    }

    public function scopeOnlyRegularized($query)
    {
        return $query->where('is_regularized', true);
    }
}
