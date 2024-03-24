<?php

namespace App\Models\Structures;

use App\Models\BaseModel;
use App\Models\CategoryHasProcess;
use App\Models\Process;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Znck\Eloquent\Traits\BelongsToThrough;

class Category extends BaseModel
{
    use HasFactory, BelongsToThrough;

    protected $fillable = ['name'];

    public $timestamps = false;

    public $with = ['processes'];

    /**
     * Getters
     */
    public function getNameAttribute($name)
    {
        return strtoupper($name);
    }

    /**
     * Relationships
     */
    public function processes()
    {
        return $this->belongsToMany(Process::class, CategoryHasProcess::class);
    }
}
