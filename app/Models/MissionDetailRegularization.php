<?php

namespace App\Models;

use App\Traits\HasMedia;
use App\Traits\HasUuid;
use App\Traits\IsCommentable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class MissionDetailRegularization extends BaseModel
{
    use HasFactory, HasUuid, HasMedia, IsCommentable;

    protected $fillable = [
        'action_to_be_taken',
        'created_at',
        'created_by_id',
        'mission_detail_id',
        'is_regularized',
        'creator_full_name',
        'rejector_full_name',
        'is_sanitation_in_progress',
        'is_rejected',
        'rejection_comment',
        'rejected_at',
        'rejected_by_id',
    ];

    public $timestamps = false;

    protected $appends = ['regularized', 'media_array'];

    public $casts = [
        'is_regularized' => 'boolean',
        'is_rejected' => 'boolean',
        'is_sanitation_in_progress' => 'boolean',
        'created_at' => 'datetime',
        'rejected_at' => 'datetime',
    ];

    public function getRegularizedAttribute()
    {
        return $this->is_regularized ? 'Levée' : 'En attente de traitement';
    }

    public function getCreatedAtAttribute($created_at)
    {
        return $created_at ? Carbon::parse($created_at)->format('d-m-Y H:i') : null;
    }

    public function getRejectedAtAttribute($rejected_at)
    {
        return $rejected_at ? Carbon::parse($rejected_at)->format('d-m-Y H:i') : null;
    }


    /**
     * Relationships
     */
    public function detail()
    {
        return $this->belongsTo(MissionDetail::class, 'mission_detail_id');
    }

    public function regularizator()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function rejector()
    {
        return $this->belongsTo(User::class, 'rejected_by_id');
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

    public function scopeOnlyRejected($query)
    {
        return $query->where('is_rejected', true);
    }
}
