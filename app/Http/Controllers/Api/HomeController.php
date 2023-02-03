<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Planning;

class HomeController extends Controller
{
    public function __invoke()
    {
        // $activeMissions = Planning::all()->filter(fn ($planning) => $planning->state == 'EN COURS');
        // $todoMissions = Planning::all()->filter(fn ($planning) => $planning->state == 'À ÉFFECTUER');
        // $delaay = Planning::all()->filter(fn ($planning) => $planning->state == 'EN RETARD');
        // $doneMissions = Planning::all()->filter(fn ($planning) => $planning->state == 'RÉALISER');
    }
}