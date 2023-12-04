<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'label',
        'name',
        'placeholder',
        'help_text',
        'columns',
        'options',
        'min_length',
        'max_length',
        'required',
        'distinct',
        'is_integer_or_float',
        'additional_rules',
        'is_multiple'
    ];

    public $appends = ['distinct_str', 'required_str'];

    public $casts = [
        'required' => 'boolean',
        'distinct' => 'boolean',
        'is_integer_or_float' => 'boolean',
        'is_multiple' => 'boolean',
    ];

    public function getIsMultipleStrAttribute()
    {
        return $this->is_multiple ? 'Oui' : 'Non';
    }

    public function getDistinctStrAttribute()
    {
        return $this->distinct ? 'Oui' : 'Non';
    }

    public function getRequiredStrAttribute()
    {
        return $this->distinct ? 'Oui' : 'Non';
    }
}
