<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;


class Media extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'original_name',
        'hash_name',
        'folder',
        'extension',
        'mimetype',
        'size',
        'attachable_type',
        'attachable_id',
    ];

    protected $appends = ['link', 'type', 'path'];

    public function getTypeAttribute()
    {
        return explode('/', $this->mimetype)[1];
    }

    public function getSizeAttribute($size)
    {
        return formatBytes($size);
    }

    public function getPathAttribute()
    {
        return $this->folder . '/' . $this->hash_name;
    }

    public function getLinkAttribute()
    {
        return env('APP_URL') . '/' . $this->path;
    }
}
