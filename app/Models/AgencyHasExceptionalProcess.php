<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class AgencyHasExceptionalProcess extends Pivot
{
    protected $table = 'agency_has_exceptional_processes';

    protected $fillable = ['is_usable'];
}
