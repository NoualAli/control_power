<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class MissionHasController extends Pivot
{
    public $table = 'mission_has_controllers';
}