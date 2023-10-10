<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MajorFactResource;
use App\Models\MajorFact;
use Illuminate\Contracts\Database\Query\Builder;
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

            // $details = $this->majorFacts();
            $details = getMissionDetails(true);
            if ($fetchFilters) {
                return $this->filters($details);
            }

            if ($campaign) {
                $details = $details->where('control_campaign_id', $campaign);
            }
            if ($sort) {
                $details = $details->sortByMultiple($sort);
            } else {
                $details = $details->orderBy('md.created_at', 'DESC')->orderBy('md.major_fact_dispatched_at', 'DESC');
            }

            if ($search) {
                $details = $details->search($search);
            }

            if ($filter) {
                // $details = $details->filter($filter);
                $details = $this->filter($details, $filter);
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

    // private function majorFacts()
    // {
    //     $majorFacts = MajorFact::with([
    //         'controlPoint'  => fn ($query) => $query->with(['process'  => fn ($query) => $query->with(['domain'  => fn ($query) => $query->with('family')])]),
    //         'agency'  => fn ($query) => $query->with('dre'),
    //         'mission' => fn ($query) => $query->with(['campaign'])
    //     ]);
    //     if (hasRole(['dcp', 'cdcr'])) {
    //         $majorFacts = $majorFacts->onlyMajorFacts()->orderBy('major_fact_dispatched_at');
    //     } elseif (hasRole(['cdc', 'ci', 'cc'])) {
    //         $majorFacts = auth()->user()->details()->onlyMajorFacts();
    //     } elseif (hasRole(['ig', 'dg', 'cdrcp', 'der'])) {
    //         $majorFacts = $majorFacts->onlyDispatchedMajorFacts()->orderBy('major_fact_dispatched_at');
    //     } elseif (hasRole(['da', 'dre'])) {
    //         $majorFacts = auth()->user()->details()->onlyDispatchedMajorFacts()->orderBy('major_fact_dispatched_at');
    //     }
    //     return $majorFacts;
    // }

    /**
     * Get details filters data
     *
     * @param Builder $details
     *
     * @return array
     */
    public function filters(Builder $details): array
    {
        $details = $details->get();

        $families = (clone $details)->groupBy('family')->keys();
        $family = getFamilies()->whereIn('name', $families)->get()->map(fn ($item) => ['id' => $item->id, 'label' => $item->name])->toArray();
        $domain = [];
        $process = [];
        $dre = [];
        $agency = [];
        $campaign = formatForSelect(getControlCampaigns()->get()->map(fn ($item) => ['id' => $item->id, 'reference' => $item->reference])->toArray(), 'reference');
        $mission = [];
        if (isset(request()->filter['campaign'])) {

            $campaigns = explode(',', request()->filter['campaign']);

            $dre = getDre()
                ->join('agencies as a', 'd.id', 'a.dre_id')
                ->join('missions as m', 'm.agency_id', 'a.id')
                ->join('mission_details as md', 'md.mission_id', 'm.id')
                ->where('major_fact', true)
                ->whereIn('m.control_campaign_id', $campaigns)
                ->get()
                ->map(fn ($item) => ['id' => $item->id, 'full_name' => $item->full_name])->toArray();
            $dre = formatForSelect($dre, 'full_name');

            if (isset(request()->filter['dre'])) {
                $dres = explode(',', request()->filter['dre']);
                $agency = getAgencies()
                    ->join('missions as m', 'm.agency_id', 'a.id')
                    ->join('mission_details as md', 'md.mission_id', 'm.id')
                    ->where('major_fact', true)
                    ->whereIn('dre_id', $dres)
                    ->get()
                    ->map(fn ($item) => ['id' => $item->id, 'full_name' => $item->full_name])->toArray();
                $agency = formatForSelect($agency, 'full_name');

                if (isset(request()->filter['agency'])) {
                    $agencies = explode(',', request()->filter['agency']);
                    $mission = getMissions()
                        ->whereIn('control_campaign_id', $campaigns)
                        ->whereIn('agency_id', $agencies)
                        ->where('md.major_fact', true)
                        ->get()
                        ->map(fn ($item) => ['id' => $item->id, 'reference' => $item->reference])->toArray();
                    $mission = formatForSelect($mission, 'reference');
                }
            }
        }

        if (isset(request()->filter['family'])) {
            $families = explode(',', request()->filter['family']);

            $domain = getDomains()
                ->whereIn('family_id', $families)
                ->get()
                ->map(fn ($item) => ['id' => $item->id, 'label' => $item->name])
                ->toArray();

            if (isset(request()->filter['domain'])) {
                $domains = explode(',', request()->filter['domain']);
                $process = getProcesses()
                    ->whereIn('domain_id', $domains)
                    ->get()
                    ->map(fn ($item) => ['id' => $item->id, 'label' => $item->name])
                    ->toArray();
            }
        }

        return compact('mission', 'campaign', 'dre', 'agency', 'family', 'domain', 'process');
    }

    /**
     * Filter data
     *
     * @param Builder $details
     * @param array $filter
     *
     * @return Builder
     */
    public function filter(Builder $details, array $filter): Builder
    {
        if (isset($filter['campaign'])) {
            $values = explode(',', $filter['campaign']);
            $details = $details->whereIn('control_campaign_id', $values);
        }

        if (isset($filter['mission'])) {
            $values = explode(',', $filter['mission']);
            $details = $details->whereIn('mission_id', $values);
        }

        if (isset($filter['score'])) {
            $values = explode(',', $filter['score']);
            $details = $details->whereIn('score', $values);
        }

        if (isset($filter['dre'])) {
            $values = explode(',', $filter['dre']);
            $details = $details->whereIn('dre_id', $values);
        }

        if (isset($filter['agency'])) {
            $values = explode(',', $filter['agency']);
            $details = $details->whereIn('agency_id', $values);
        }

        if (isset($filter['family'])) {
            $values = explode(',', $filter['family']);
            $details = $details->whereIn('family_id', $values);
        }

        if (isset($filter['domain'])) {
            $values = explode(',', $filter['domain']);
            $details = $details->whereIn('domain_id', $values);
        }

        if (isset($filter['process'])) {
            $values = explode(',', $filter['process']);
            $details = $details->whereIn('process_id', $values);
        }

        if (isset($filter['is_regularized'])) {
            $value = $filter['is_regularized'] == 'Non levée' ? 0 : 1;
            $details = $details->where('is_regularized', $value);
        }
        return $details;
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
