<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Znck\Eloquent\Traits\BelongsToThrough;

class Category extends Model
{
    use HasFactory, BelongsToThrough;

    protected $fillable = ['name'];

    protected $appends = ['processes_tags'];

    public $timestamps = false;

    /**
     * Getters
     */
    public function getNameAttribute($name)
    {
        return strtoupper($name);
    }

    public function getProcessesTagsAttribute()
    {
        $processes = $this->processes()->pluck('name')->flatten()->toArray();
        $tags = '';
        foreach ($processes as $process) {
            $tags .= '<span class="tag">' . $process . '</span>';
        }
        return $tags;
    }

    /**
     * Relationships
     */
    public function processes()
    {
        return $this->belongsToMany(Process::class, CategoryHasProcess::class);
    }
}
