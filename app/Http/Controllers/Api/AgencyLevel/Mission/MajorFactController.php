<?php

namespace App\Http\Controllers\Api\AgencyLevel\Mission;

use App\DB\Queries\ControlCampaignQuery;
use App\DB\Queries\MajorFactQuery;
use App\DB\Queries\MissionQuery;
use App\Http\Controllers\Controller;
use App\Http\Resources\MajorFactResource;
use App\Models\MissionDetail;
use App\Models\User;
use App\Notifications\Mission\MajorFact\Detected;
use App\Notifications\Mission\MajorFact\Rejected;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

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
            $details = (new MajorFactQuery('mission_details', 'md'))->prepare()->multiple();
            if ($fetchFilters) {
                return $this->filters($details);
            }

            if ($campaign) {
                $details = $details->where('control_campaign_id', $campaign);
            }

            if ($sort) {
                $details = $details->sortByMultiple($sort);
            } else {
                $details = $details->orderBy('md.created_at', 'DESC')->orderBy('md.major_fact_is_dispatched_at', 'DESC');
            }

            if ($search) {
                $details = $details->search(['md.reference'], $search);
            }

            if ($filter) {
                $details = $this->filter($details, $filter);
            }

            if ($fetchAll) {
                $details = $details->get()->pluck('reference', 'id');
            } else {
                $details = MajorFactResource::collection($details->paginate($perPage)->onEachSide(1));
            }
            return $details;
        } catch (\Throwable $th) {
            return throwedError($th);
        }
    }

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
        $family = getFamilies()->whereIn('f.name', $families)->get()->map(fn ($item) => ['id' => $item->id, 'label' => $item->name])->toArray();
        $domain = [];
        $process = [];
        $campaign = (new ControlCampaignQuery())->query->whereNotNull('validated_at')->orderBy('reference', 'DESC')->get();
        $mission = (new MissionQuery())->query->get();

        $campaign = formatForSelect($campaign->toArray(), 'reference');
        $mission = formatForSelect($mission->toArray(), 'reference');

        $dres = [];
        if (isset(request('filter')['dre']) && !empty(request('filter')['dre'])) {
            $dres = explode(',', request('filter')['dre']);
        }
        $dre = getDre()->leftJoin('agencies AS a', 'a.dre_id', 'd.id');
        $agency = [];

        if (!empty($dres)) {
            $agency = getAgencies()->leftJoin('dres AS d', 'd.id', 'a.dre_id')->whereIn('d.id', $dres);
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

        $state = collect([]);
        if ($details->contains('reg_is_regularized', '1')) {
            $state->push(['id' => 'Levée', 'label' => 'Levée']);
        }
        if ($details->contains('reg_is_rejected', '1')) {
            $state->push(['id' => 'Rejetée', 'label' => 'Rejetée']);
        }
        if ($details->contains('reg_is_sanitation_in_progress', '1')) {
            $state->push(['id' => 'En cours d\'assainissement', 'label' => 'En cours d\'assainissement']);
        }
        if ($details->contains(fn ($item) => (int) $item->total_regularizations == 0)) {
            $state->push(['id' => 'En attente de traitement', 'label' => 'En attente de traitement']);
        }


        $dre = formatForSelect($dre->get()->toArray(), 'full_name');
        if (!empty($dres)) {
            $agency = formatForSelect($agency->get()->toArray(), 'full_name');
        }
        return compact('mission', 'campaign', 'dre', 'agency', 'family', 'domain', 'process', 'state');
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
        if (isset($filter['id'])) {
            $value = $filter['id'];
            $details = $details->having('md.id', "$value");
        }

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
            $details = $details->whereIn('a.dre_id', $values);
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
        if (isset($filter['with_metadata'])) {
            $value = $filter['with_metadata'];
            if ($value == 'Oui') {
                $details = $details->whereNotNull('metadata');
            } else {
                $details = $details->whereNull('metadata');
            }
        }
        if (isset($filter['state'])) {
            $value = $filter['state'];
            if ($value == 'Levée') {
                $details = $details->where('reg_is_regularized', true);
            } elseif ($value == 'Rejetée') {
                $details = $details->where('reg_is_rejected', true);
            } elseif ($value == 'En attente de traitement') {
                $details = $details->where('reg_is_sanitation_in_progress', false)->where('reg_is_regularized', false)->where('reg_is_rejected', false);
            } elseif ($value == 'En cours d\'assainissement') {
                $details = $details->where('reg_is_sanitation_in_progress', true);
            }
        }
        return $details;
    }

    /**
     * Send notification for specified major fact
     *
     * @param MissionDetail $detail
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function notify(MissionDetail $detail)
    {
        try {
            $users = collect([]);
            $result = true;
            $user = auth()->user();
            $userFullName = getUserFullNameWithRole();
            if (hasRole('cdc')) {
                $result = $detail->update([
                    'major_fact_is_dispatched_to_dcp_at' => now(),
                    'major_fact_is_dispatched_to_dcp_by_id' => $user->id,
                    'major_fact_is_dispatched_to_dcp_by_full_name' => $userFullName,
                ]);
                $users = User::whereRoles(['cdcr', 'dcp'])->isActive()->get();
            } elseif (hasRole('dcp')) {
                $result = $detail->update([
                    'major_fact_is_dispatched_at' => now(),
                    'major_fact_is_dispatched_by_id' => $user->id,
                    'major_fact_is_dispatched_by_full_name' => $userFullName,
                ]);
                $roles = ['cdrcp', 'ig', 'iga', 'dg', 'dga', 'der', 'deac', 'sg'];
                $users = User::whereRoles($roles)->isActive()->get();
                // $users = User::whereRoles(['dre', 'da'])->whereRelation('agencies', 'agencies.id', $detail->mission->agency_id)->get()->merge($users);
                $users = User::whereRoles(['dre', 'ir'])->whereRelation('agencies', 'agencies.id', $detail->mission->agency_id)->isActive()->get()->merge($users);
            }

            if ($users->count() && $result) {
                foreach ($users as $user) {
                    Notification::send($user, new Detected($detail));
                }
            }
            return actionResponse($result, NOTIFICATION_SUCCESS);
        } catch (\Throwable $th) {
            return throwedError($th);
        }
    }

    /**
     * Reject specified major fact
     *
     * @param MissionDetail $detail
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function reject(MissionDetail $detail)
    {
        try {
            $result = DB::transaction(function () use ($detail) {
                $user = auth()->user();
                $userFullName = getUserFullNameWithRole();
                $result = $detail->update([
                    'major_fact' => false,
                    'major_fact_is_rejected_at_dre' => hasRole('cdc'),
                    'major_fact_is_rejected_at_dcp' => hasRole(['dcp', 'cdcr', 'cc']),
                    'major_fact_is_rejected_by_full_name' => $userFullName,
                    'major_fact_is_rejected_by_id' => $user->id,
                    'major_fact_is_rejected_at' => now(),
                    'major_fact_is_dipatched_to_dcp_at' => null,
                    'major_fact_is_dipatched_to_dcp_by_full_name' => null,
                    'major_fact_is_dipatched_to_dcp_by_id' => null,
                ]);

                return $result;
            });

            if (!config('mail.disabled')) {
                $majorFactDetectorRole = $detail->majorFactDetector?->role?->code;
                $users = collect([]);
                if (hasRole('cdc')) {
                    $users = [$detail->mission->dreController];
                } elseif (hasRole('cdcr')) {
                    if (in_array($majorFactDetectorRole, ['cdc', 'ci'])) {
                        $users = User::whereRoles('cdc')->isActive()->whereRelation('agencies', 'agencies.id', $detail->mission->agency_id)->get();
                    } else {
                        $users = User::whereRoles('cc')->isActive()->get();
                    }
                } elseif (hasRole('dcp')) {
                    if (in_array($majorFactDetectorRole, ['cdc', 'ci'])) {
                        $users = User::whereRoles('cdc')->isActive()->whereRelation('agencies', 'agencies.id', $detail->mission->agency_id)->get();
                        $users = $users->merge(User::whereRoles('cdcr')->isActive()->get());
                    } else {
                        $users = User::whereRoles('cdcr')->isActive()->get();
                    }
                }

                if ($result) {
                    foreach ($users as $user) {
                        Notification::send($user, new Rejected($detail));
                    }
                }
            }

            return actionResponse($result, 'Fait majeur rejeter avec succès');
        } catch (\Throwable $th) {
            return throwedError($th);
        }
    }
}
