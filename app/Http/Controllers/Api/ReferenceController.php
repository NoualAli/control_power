<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PCFResource;
use App\Models\ControlPoint;
use Illuminate\Http\Request;

class ReferenceController extends Controller
{
    public function pcf()
    {
        $controlPoints = new ControlPoint;

        $filter = request()->has('filter') ? request()->filter : null;
        if ($filter) {
            $controlPoints = $controlPoints->filter($filter);
        }
        return PCFResource::collection($controlPoints->paginate()->onEachSide(1));
    }
}