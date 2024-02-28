<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes, HasUuid;

    public $fillable = [
        'id',
        'content',
        'type',
        'created_by_id',
        'commentable_type',
        'commentable_id',
        'creator_full_name'
    ];

    public $casts = [
        'created_at' => 'datetime:d-m-Y H:i'
    ];

    /**
     * Relationships
     */

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
