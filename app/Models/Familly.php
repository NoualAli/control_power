<?php

namespace App\Models;

use App\Traits\IsOrderable;
use App\Traits\IsSearchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Familly extends Model
{
    use HasFactory, IsOrderable, IsSearchable;

    protected $fillable = [
        'name',
    ];

    public $timestamps = false;

    public $withCount = ['domains'];

    protected $searchable = ['name'];

    /**
     * Getters
     */

    /**
     * Relationships
     */
    public function domains()
    {
        return $this->hasMany(Domain::class);
    }

    public function processes()
    {
        return $this->hasManyThrough(Process::class, Domain::class);
    }
}