<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MajorFactResource;
use App\Models\Agency;
use App\Models\ControlCampaign;
use App\Models\Domain;
use App\Models\Familly;
use App\Models\MajorFact;
use App\Models\Mission;
use App\Models\Process;
use Illuminate\Http\Request;

class MajorFactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        isAbleOrAbort(['view_major_fact']);
        $filter = request('filter', null);
        $search = request('search', null);
        $sort = request('sort', null);
        $fetchFilters = request()->has('fetchFilters');
        $perPage = request('perPage', 10);
        $fetchAll = request()->has('fetchAll');
        $campaign = request('campaign_id', null);

        try {
            if ($fetchFilters) {
                return $this->filters();
            }

            $details = $this->majorFacts();

            if ($campaign) {
                $details = $details->where('control_campaign_id', $campaign);
            }
            if ($sort) {
                $details = $details->sortByMultiple($sort);
            } else {
                $details = $details->orderBy('created_at', 'DESC');
            }

            if ($search) {
                $details = $details->search($search);
            }

            if ($filter) {
                $details = $details->filter($filter);
            }

            if ($fetchAll) {
                $details = $details->get()->pluck('reference', 'id');
            } else {
                $details = MajorFactResource::collection($details->paginate($perPage)->onEachSide(1));
            }
            return $details;
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ], 500);
        }
    }

    private function majorFacts()
    {
        $majorFacts = MajorFact::with([
            'controlPoint'  => fn ($query) => $query->with(['process'  => fn ($query) => $query->with(['domain'  => fn ($query) => $query->with('familly')])]),
            'agency'  => fn ($query) => $query->with('dre'),
            'mission' => fn ($query) => $query->with(['campaign'])
        ]);
        if (hasRole(['dcp', 'cdcr'])) {
            $majorFacts = $majorFacts->onlyMajorFacts()->orderBy('major_fact_dispatched_at');
        } elseif (hasRole(['cdc', 'ci', 'cc'])) {
            $majorFacts = auth()->user()->details()->onlyMajorFacts();
        } elseif (hasRole(['ig', 'dg', 'cdrcp', 'der'])) {
            $majorFacts = $majorFacts->onlyDispatchedMajorFacts()->orderBy('major_fact_dispatched_at');
        } elseif (hasRole(['da', 'dre'])) {
            $majorFacts = auth()->user()->details()->onlyDispatchedMajorFacts()->orderBy('major_fact_dispatched_at');
        }
        return $majorFacts;
    }

    private function filters()
    {
        $majorFacts = $this->majorFacts();

        $family = $majorFacts->relationUniqueData('familly');
        $domain = $majorFacts->relationUniqueData('domain');
        $process = $majorFacts->relationUniqueData('process');
        $dre = $majorFacts->relationUniqueData('dre', 'full_name');
        $agency = $majorFacts->relationUniqueData('agency', 'full_name');
        $mission = $majorFacts->relationUniqueData('mission', 'reference');
        $campaign = $majorFacts->relationUniqueData('campaign', 'reference');
        return compact('mission', 'family', 'domain', 'process', 'agency', 'campaign', 'dre');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MajorFact  $majorFact
     * @return \Illuminate\Http\Response
     */
    public function show(MajorFact $majorFact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MajorFact  $majorFact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MajorFact $majorFact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MajorFact  $majorFact
     * @return \Illuminate\Http\Response
     */
    public function destroy(MajorFact $majorFact)
    {
        //
    }
}
