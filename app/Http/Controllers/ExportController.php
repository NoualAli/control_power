<?php

namespace App\Http\Controllers;

use App\Exports\AgenciesExport;
use App\Exports\ControlPointsExport;
use App\Exports\DomainProcessesExport;
use App\Exports\DomainsExport;
use App\Exports\DreAgenciesExport;
use App\Exports\DresExport;
use App\Exports\FamiliesExport;
use App\Exports\FamilyDomainsExport;
use App\Exports\LoginsExport;
use App\Exports\ModulesExport;
use App\Exports\ProcessControlPointsExport;
use App\Exports\ProcessesExport;
use App\Exports\RolePermissionsExport;
use App\Exports\RolesExport;
use App\Exports\SynthesisExport;
use App\Exports\SynthesisWithReportsExport;
use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Models\Agency;
use App\Models\ControlPoint;
use App\Models\Domain;
use App\Models\Dre;
use App\Models\Family;
use App\Models\MissionDetail;
use App\Models\Module;
use App\Models\Process;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use stdClass;

class ExportController extends Controller
{
    public function export(Request $request)
    {
        if (hasRole(['cdrcp', 'dcp', 'cdcr', 'cdc', 'root', 'admin'])) {
            $exportValue = $request->export;
            if ($exportValue == 'users') {
                return $this->users($request);
            } elseif ($exportValue == 'roles') {
                return $this->roles($request);
            } elseif ($exportValue == 'modules') {
                return $this->modules();
            } elseif ($exportValue == 'dres') {
                return $this->dres($request);
            } elseif ($exportValue == 'agencies') {
                return $this->agencies();
            } elseif ($exportValue == 'families') {
                return $this->families($request);
            } elseif ($exportValue == 'domains') {
                return $this->domains($request);
            } elseif ($exportValue == 'processes') {
                return $this->processes($request);
            } elseif ($exportValue == 'control_points') {
                return $this->controlPoints();
            } elseif ($exportValue == 'synthesis') {
                return $this->synthesis($request);
            } elseif ($exportValue == 'synthesis_reports') {
                return $this->synthesis($request, true);
            } else {
                abort(400, 'L\'action ' . $exportValue . ' n\'est pas reconnue');
            }
        } else {
            abort(FORBIDDEN, 'Vous n\'êtes pas autorisé à effectuer cette action');
        }
    }

    private function synthesis(Request $request, bool $withReports = false)
    {
        $controlCampaign = DB::table('control_campaigns')->select('id', 'reference')->where('id', $request->campaign)->first();
        $agencies = DB::table('missions', 'm')->select([
            'd.id as dre_id',
            DB::raw("CONCAT(d.code, ' ', d.name) as dre"),
            'a.id as agency_id',
            DB::raw("CONCAT(a.code, ' ', a.name) as agency"),
        ])
            ->leftJoin('agencies as a', 'a.id', 'm.agency_id')
            ->leftJoin('dres as d', 'd.id', 'a.dre_id')
            ->where('m.control_campaign_id', $controlCampaign->id);


        $dresFromAgencies = (clone $agencies)->select([
            'd.id as dre_id',
            DB::raw("CONCAT(d.code, ' - ', d.name) as dre"),
        ])->groupBy('d.id', 'd.name', 'd.code')
            ->orderBy('d.code')
            ->orderBy('d.name')
            ->get();

        $missionDetails = DB::table('control_campaigns', 'cc')->select([
            'f.name as family',
            'd.name as domain',
            'p.name as process',
            'cp.name as control_point',
            'md.id',
            'score',
            'is_disabled',
            'reg_is_regularized',
            DB::raw("CONCAT(dres.code, ' ', dres.name) as dre"),
            DB::raw("CONCAT(a.code, ' ', a.name) as agency"),
            'a.id as agency_id'
        ])
            ->leftJoin('missions as m', 'm.control_campaign_id', 'cc.id')
            ->leftJoin('mission_details as md', 'md.mission_id', 'm.id')
            ->leftJoin('agencies as a', 'a.id', 'm.agency_id')
            ->leftJoin('dres', 'dres.id', 'a.dre_id')
            ->leftJoin('control_points as cp', 'cp.id', 'md.control_point_id')
            ->leftJoin('processes as p', 'p.id', 'cp.process_id')
            ->leftJoin('domains as d', 'd.id', 'p.domain_id')
            ->leftJoin('families as f', 'f.id', 'd.family_id')
            ->where('cc.id', $request->campaign)
            ->whereIn('score', [1, 2, 3, 4])
            ->where('is_disabled', false)
            ->orderBy('f.id')
            ->orderBy('d.id')
            ->orderBy('p.id')
            ->orderBy('cp.name');
        if (hasRole('cdc')) {
            $missionDetails = $missionDetails->whereIn('a.id', auth()->user()->agencies->pluck('id')->toArray());
        }
        $dres = collect([]);
        foreach ($dresFromAgencies as $dre) {
            $dreAgencies = (clone $agencies)->where('dre_id', $dre->dre_id)->get();
            if ($dreAgencies->count()) {
                $single_dre = new stdClass;
                $single_dre->dre = $dre->dre;
                $dreAgencies = $dreAgencies;
                $single_dre->agencies = $dreAgencies;
                $single_dre->total_agencies = $dreAgencies->count();
                $single_dre->agencies = $dreAgencies;
                foreach ($single_dre->agencies as $agency) {
                    if ($withReports) {
                        $missionDetails = $missionDetails->addSelect('recovery_plan');
                    }

                    $agency->data = (clone $missionDetails)->where('dres.id', $dre->dre_id)->where('a.id', $agency->agency_id)->get();

                    if ($withReports) {
                        $agency->data->map(function ($item) {
                            $observation = DB::table('comments')->where('commentable_type', MissionDetail::class)->where('commentable_id', $item->id)->whereIn('type', ['ci_observation', 'cdc_observation'])
                                ->orderBy('created_at', 'DESC')->first();
                            $item->observation = $observation->content;
                            return $item;
                        });
                    }
                }
                $dres->push($single_dre);
            }
        }

        $controlPoints = DB::table('control_campaign_processes', 'ccp')
            ->select([
                'f.name as family',
                'd.name as domain',
                'p.name as process',
                'cp.name as control_point',
                'cp.id',
            ])
            ->leftJoin('processes as p', 'p.id', 'ccp.process_id')
            ->leftJoin('control_points as cp', 'p.id', 'cp.process_id')
            ->leftJoin('domains as d', 'd.id', 'p.domain_id')
            ->leftJoin('families as f', 'f.id', 'd.family_id')
            ->where('ccp.control_campaign_id', $request->campaign)
            ->orderBy('f.id')
            ->orderBy('d.id')
            ->orderBy('p.id')
            ->orderBy('cp.id')
            ->get();

        if ($withReports) {
            return Excel::download(new SynthesisWithReportsExport(compact('dres', 'controlPoints', 'controlCampaign')), 'synthèse-constast-' . $controlCampaign->reference . '.xlsx');
        }
        return Excel::download(new SynthesisExport(compact('dres', 'controlPoints', 'controlCampaign')), 'synthèse-' . $controlCampaign->reference . '.xlsx');
    }

    private function users(Request $request)
    {
        if ($request->has('id')) {
            $user = User::findOrFail($request->id);
            return Excel::download(new LoginsExport($user), 'authentifications-' . \Str::slug($user->full_name) . '.xlsx');
        } else {
            $users = User::with(['dres', 'role', 'last_login'])->get();
            return Excel::download(new UsersExport($users), 'liste_des_utilisateurs.xlsx');
        }
    }

    private function roles(Request $request)
    {
        if ($request->has('id')) {
            $role = Role::findOrFail($request->id)->load('permissions');
            return Excel::download(new RolePermissionsExport($role), 'permissions-' . $role->code . '.xlsx');
        } else {
            $roles = Role::all();
            return Excel::download(new RolesExport($roles), 'liste_des_rôles.xlsx');
        }
    }

    private function modules()
    {
        $modules = Module::with('permissions')->get();
        return Excel::download(new ModulesExport($modules), 'liste_des_modules.xlsx');
    }

    private function dres(Request $request)
    {
        if ($request->has('id')) {
            $dre = Dre::findOrFail($request->id)->load('agencies');
            return Excel::download(new DreAgenciesExport($dre), 'agences-' . \Str::slug($dre->full_name) . '.xlsx');
        } else {
            $dres = Dre::withCount('agencies')->get();
            return Excel::download(new DresExport($dres), 'liste_des_dre.xlsx');
        }
    }

    private function agencies()
    {
        $agencies = Agency::with(['category', 'dre'])->get();
        return Excel::download(new AgenciesExport($agencies), 'liste_des_agences.xlsx');
    }

    private function families(Request $request)
    {
        if ($request->has('id')) {
            $family = Family::findOrFail($request->id)->load(['domains' => fn ($query) => $query->withCount('processes')]);
            return Excel::download(new FamilyDomainsExport($family), 'domaines-' . \Str::slug($family->name) . '.xlsx');
        } else {
            $families = Family::withCount('domains')->get();
            return Excel::download(new FamiliesExport($families), 'liste_des_familles.xlsx');
        }
    }

    private function domains(Request $request)
    {
        if ($request->has('id')) {
            $domain = Domain::findOrFail($request->id)->load(['processes' => fn ($query) => $query->withCount('control_points')]);
            return Excel::download(new DomainProcessesExport($domain), 'processus-' . \Str::slug($domain->name) . '.xlsx');
        } else {
            $domains = Domain::with('family')->withCount('processes')->get();
            return Excel::download(new DomainsExport($domains), 'liste_des_domaines.xlsx');
        }
    }

    private function processes(Request $request)
    {
        if ($request->has('id')) {
            $process = Process::findOrFail($request->id)->load('control_points');
            return Excel::download(new ProcessControlPointsExport($process), 'points_de_contrôle-' . \Str::slug($process->name) . '.xlsx');
        } else {
            $processes = Process::with(['domain', 'family'])->withCount('control_points')->get();
            return Excel::download(new ProcessesExport($processes), 'liste_des_processus.xlsx');
        }
    }

    private function controlPoints()
    {
        $controlPoints = ControlPoint::with('fields')->get();
        return Excel::download(new ControlPointsExport($controlPoints), 'liste_des_points_de_contrôle.xlsx');
    }
}
