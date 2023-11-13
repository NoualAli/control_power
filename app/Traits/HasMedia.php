<?php

namespace App\Traits;

use App\Models\Media;

trait HasMedia
{

    /**
     * Getters
     */

    public function getMediaArrayAttribute()
    {
        return $this->media->map(fn ($item) => $item->id);
    }

    /**
     * Relationships
     */
    public function media()
    {
        return $this->morphMany(Media::class, 'attachable');
    }

    public function images()
    {
        return $this->morphMany(Media::class, 'attachable')->whereIn('extension', ['jpg', 'jpeg', 'png', 'svg']);
    }
}
