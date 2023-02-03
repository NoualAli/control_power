<?php

use App\Models\Media;

trait HasMedia
{
    /**
     * Methods
     */


    /**
     * Relationships
     */
    public function cover()
    {
        return $this->belongsTo(Media::class);
    }

    public function media()
    {
        return $this->morphMany(Media::class);
    }
}