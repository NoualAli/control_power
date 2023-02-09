<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
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
}