<?php

namespace App\Models;

use App\Traits\IsOrderable;
use App\Traits\IsSearchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    use HasFactory, IsSearchable, IsOrderable;

    protected $fillable = [
        'name',
        'code',
        'dre_id',
    ];

    protected $perPage = 10;

    public $timestamps = false;

    protected $searchable = ['name', 'code'];

    protected $appends = [
        'full_name'
    ];

    /**
     * Getters
     */
    public function getFullNameAttribute()
    {
        return $this->code . ' - ' . $this->name;
    }

    /**
     * Relationships
     */
    public function dre()
    {
        return $this->belongsTo(Dre::class);
    }
}