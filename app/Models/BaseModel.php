<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BaseModel extends Model
{
    public function scopeWithRowNumber($query)
    {
        return $query->select(DB::raw('*, ROW_NUMBER() OVER (ORDER BY id) as row_number'));
    }
}
