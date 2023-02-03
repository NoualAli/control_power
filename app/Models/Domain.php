<?php

namespace App\Models;

use App\Traits\IsOrderable;
use App\Traits\IsSearchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    use HasFactory, IsSearchable, IsOrderable;

    protected $fillable = [
        'name',
        'familly_id',
    ];

    public $timestamps = false;

    protected $searchable = ['name'];

    public $withCount = ['processes'];

    /**
     * Getters
     */
    /**
     * Relationships
     */
    public function familly()
    {
        return $this->belongsTo(Familly::class);
    }
    public function processes()
    {
        return $this->hasMany(Process::class);
    }
}