<?php

namespace App\Traits;

use App\Models\Field;

trait HasFields
{
    /**
     * Relationships
     */
    public function fields()
    {
        return $this->morphToMany(Field::class, 'attachable', 'has_fields')->withTimestamps()->orderBy('has_fields.created_at', 'ASC');
    }
}
