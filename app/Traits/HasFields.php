<?php

namespace App\Traits;

use Ramsey\Uuid\Guid\Fields;

trait HasFields
{
    /**
     * Relationships
     */
    public function fields()
    {
        return $this->morphToMany(Fields::class, 'metadatable', 'has_metadata');
    }
}
