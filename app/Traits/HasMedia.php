<?php

namespace App\Traits;

use App\Models\Media;

trait HasMedia
{
    /**
     * Relationships
     */
    public function media()
    {
        return $this->morphMany(Media::class, 'attachable');
    }
}
