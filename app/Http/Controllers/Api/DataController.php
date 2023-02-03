<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DetailPoint;
use App\Models\Mission;
use Illuminate\Support\Facades\DB;
use Throwable;

class DataController extends Controller
{
    public function missions_state()
    {
        dd(hasRole('root'));
        $missions = Mission::all();
        $active = (clone $missions)->filter(fn ($planning) => $planning->realisation_state == 'EN COURS')->count();
        $todo = (clone $missions)->filter(fn ($planning) => $planning->realisation_state == 'À RÉALISER')->count();
        $delay = (clone $missions)->filter(fn ($planning) => $planning->realisation_state == 'EN RETARD')->count();
        $done = (clone $missions)->filter(fn ($planning) => $planning->realisation_state == 'RÉALISÉ' || $planning->realisation_state == 'Validé et envoyé')->count();

        return hasRole('root') ? [] : response()->json(compact('delay', 'active', 'todo', 'done'));
    }

    public function missions_percentage()
    {
        $total = Mission::where('validated_at', '!=', null)->count();
        $validated = Mission::validated()->count() * 100;
        $notValidated = Mission::notValidated()->count() * 100;
        try {
            $validated = number_format($validated / $total, 2);
            $notValidated = number_format($notValidated / $total, 2);
        } catch (Throwable $th) {
        }


        return hasRole('root') ? [] : compact('notValidated', 'validated');
    }

    public function campaigns_anomalies()
    {
        $anomalies = DB::table('v_campaigns_anomalies');
        return hasRole('root') ? [] : $anomalies->get()->pluck('total_anomalies', 'reference')->toArray();
    }

    public function score_anomalies()
    {
        $anomalies = DB::table('v_score_anomalies');
        return hasRole('root') ? [] : $anomalies->get()->pluck('total', 'score')->toArray();
    }

    public function dres_anomalies()
    {
        $anomalies = DB::table('v_dres_anomalies');

        // if (!hasRole(['dcp', 'dg'])) {
        //     $anomalies = $anomalies->where('dre_id', auth()->user()->dre->id);
        // }
        // $totalAnomalis = DetailPoint::anomalies()->count();
        // $anomalies = $anomalies->get()->map(function ($anomalie) use ($totalAnomalis) {
        //     $anomalie->total_anomalies = number_format(($anomalie->total_anomalies * 100) / $totalAnomalis, 1);
        //     return hasRole('root') ? [] : $anomalie;
        // })->pluck('total_anomalies', 'dre')->toArray();
        // return hasRole('root') ? [] : $anomalies;
        return []
    }

    public function agencies_anomalies()
    {
        $anomalies = DB::table('v_agencies_anomalies');
        // if (!hasRole(['dcp', 'dg'])) {
        //     $anomalies = $anomalies->whereIn('agency_id', auth()->user()->dre->agencies()->pluck('agencies.id')->toArray());
        // }

        return hasRole('root') ? [] : $anomalies->get()->pluck('total_anomalies', 'agency')->toArray();
    }

    public function famillies_anomalies()
    {
        $anomalies = DB::table('v_famillies_anomalies');
        return hasRole('root') ? [] : $anomalies->get()->pluck('total_anomalies', 'familly')->toArray();
    }

    public function domains_anomalies()
    {
        $anomalies = DB::table('v_domains_anomalies');
        return hasRole('root') ? [] : $anomalies->get()->pluck('total_anomalies', 'domain')->toArray();
    }

    public function processes_anomalies()
    {
        $anomalies = DB::table('v_processes_anomalies');
        return hasRole('root') ? [] : $anomalies->get()->pluck('total_anomalies', 'process')->toArray();
    }


    public function missions_anomalies()
    {
        $anomalies = DB::table('v_missions_anomalies');
        // if (!hasRole(['dcp', 'dg'])) {
        //     $anomalies->whereIn('agency_id', auth()->user()->dre->agencies()->pluck('agencies.id')->toArray());
        // }
        return hasRole('root') ? [] : $anomalies->get()->pluck('total_anomalies', 'mission_reference')->toArray();
    }

    public function campaigns_major_facts()
    {
        $majorFacts = DB::table('v_campaigns_major_facts');
        return hasRole('root') ? [] : $majorFacts->get()->pluck('total_major_facts', 'reference')->toArray();
    }

    public function dres_major_facts()
    {
        $majorFacts = DB::table('v_dres_major_facts');

        // if (!hasRole(['dcp', 'dg'])) {
        //     $majorFacts = $majorFacts->where('dre_id', auth()->user()->dre->id);
        // }

        return hasRole('root') ? [] : $majorFacts->get()->pluck('total_major_facts', 'dre')->toArray();
    }

    public function agencies_major_facts()
    {
        $majorFacts = DB::table('v_agencies_major_facts');
        // if (!hasRole(['dcp', 'dg'])) {
        //     $majorFacts = $majorFacts->whereIn('agency_id', auth()->user()->dre->agencies()->pluck('agencies.id')->toArray());
        // }

        return hasRole('root') ? [] : $majorFacts->get()->pluck('total_major_facts', 'agency')->toArray();
    }

    public function famillies_major_facts()
    {
        $majorFacts = DB::table('v_famillies_major_facts');
        return hasRole('root') ? [] : $majorFacts->get()->pluck('total_major_facts', 'familly')->toArray();
    }

    public function domains_major_facts()
    {
        $majorFacts = DB::table('v_domains_major_facts');
        return hasRole('root') ? [] : $majorFacts->get()->pluck('total_major_facts', 'domain')->toArray();
    }

    public function processes_major_facts()
    {
        $majorFacts = DB::table('v_processes_major_facts');
        return hasRole('root') ? [] : $majorFacts->get()->pluck('total_major_facts', 'process')->toArray();
    }

    public function missions_major_facts()
    {
        $majorFacts = DB::table('v_missions_major_facts');
        // if (!hasRole(['dcp', 'dg'])) {
        //     $majorFacts->whereIn('agency_id', auth()->user()->dre->agencies()->pluck('agencies.id')->toArray());
        // }
        return hasRole('root') ? [] : $majorFacts->get()->pluck('total_major_facts', 'mission_reference')->toArray();
    }
}
