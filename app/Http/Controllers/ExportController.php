<?php

namespace App\Http\Controllers;

use App\DB\Queries\ControlCampaignQuery;
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
use App\Exports\RegionalInspectionDresExport;
use App\Exports\RegionalInspectionsExport;
use App\Exports\RolePermissionsExport;
use App\Exports\RolesExport;
use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Jobs\GenerateSummaryOfReports;
use App\Models\ControlCampaign;
use App\Models\Structures\Agency;
use App\Models\ControlPoint;
use App\Models\Domain;
use App\Models\Structures\Dre;
use App\Models\Family;
use App\Models\Module;
use App\Models\Process;
use App\Models\Role;
use App\Models\Structures\RegionalInspection;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;

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
            } elseif ($exportValue == 'regional-inspections') {
                return $this->regional_inspections($request);
            } else {
                abort(400, 'L\'action ' . $exportValue . ' n\'est pas reconnue');
            }
        } else {
            abort(FORBIDDEN, 'Vous n\'êtes pas autorisé à effectuer cette action');
        }
    }

    private function synthesis(Request $request, bool $withReports = false)
    {
        try {
            $campaign = (new ControlCampaignQuery())->prepare()->query->having('cc.id', $request->campaign)->addSelect('cc.description')->groupBy('cc.description')->first();

            if ($campaign) {
                $campaign->summary_scores = getMediaByForeign(ControlCampaign::class, $campaign?->id, 'control_campaign_summary_scores')->first();
                $campaign->summary_reports = getMediaByForeign(ControlCampaign::class, $campaign?->id, 'control_campaign_summary_reports')->first();
            }

            $generate = true;

            if ($withReports) {
                $generate = is_null($campaign->summary_reports);
            } else {
                $generate = is_null($campaign->summary_scores);
            }
            $pendingJobs = 0;
            $jobId = null;
            if ($generate) {
                $jobs = [];
                $jobs[] = new GenerateSummaryOfReports(auth()->user(), $request->campaign, $withReports);
                $batch = Bus::batch($jobs)->dispatch();
                $pendingJobs = $batch->pendingJobs;
                $jobId = $batch->id;
                $message = "La génération du fichier excel à commencer un email vous sera envoyé une fois le fichier prêt.";
            } else {
                $message = "Veuillez recharger votre page s'il vous plaît.";
            }

            return response()->json([
                'message' => $message,
                'pending_jobs' => $pendingJobs,
                'job_id' => $jobId,
                'status' => $generate,
            ]);
        } catch (\Throwable $th) {
            return throwedError($th);
        }
    }

    private function users(Request $request)
    {
        if ($request->has('id')) {
            $user = User::findOrFail($request->id);
            return Excel::download(new LoginsExport($user), 'authentifications-' . Str::slug($user->full_name) . '.xlsx');
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

    private function regional_inspections(Request $request)
    {
        if ($request->has('id')) {
            $regional_inspection = RegionalInspection::findOrFail($request->id)->load('dres');
            return Excel::download(new RegionalInspectionDresExport($regional_inspection), 'dre-' . Str::slug($regional_inspection->full_name) . '.xlsx');
        } else {
            $regional_inspections = Dre::withCount('dres')->get();
            return Excel::download(new RegionalInspectionsExport($regional_inspections), 'liste_des_inspections_régionales.xlsx');
        }
    }

    private function dres(Request $request)
    {
        if ($request->has('id')) {
            $dre = Dre::findOrFail($request->id)->load('agencies');
            return Excel::download(new DreAgenciesExport($dre), 'agences-' . Str::slug($dre->full_name) . '.xlsx');
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
            $family = getFamilies($request->id);
            return Excel::download(new FamilyDomainsExport($family), 'domaines-' . Str::slug($family->name) . '.xlsx');
        } else {
            $families = getFamilies()->get();
            return Excel::download(new FamiliesExport($families), 'liste_des_familles.xlsx');
        }
    }

    private function domains(Request $request)
    {
        if ($request->has('id')) {
            $domain = getDomains(request('id'));
            return Excel::download(new DomainProcessesExport($domain), 'processus-' . Str::slug($domain->name) . '.xlsx');
        } else {
            $domains = getDomains()->get();
            return Excel::download(new DomainsExport($domains), 'liste_des_domaines.xlsx');
        }
    }

    private function processes(Request $request)
    {
        if ($request->has('id')) {
            $process = getProcesses($request->id);
            return Excel::download(new ProcessControlPointsExport($process), 'points_de_contrôle-' . Str::slug($process->name) . '.xlsx');
        } else {
            $processes = getProcesses()->get();
            return Excel::download(new ProcessesExport($processes), 'liste_des_processus.xlsx');
        }
    }

    private function controlPoints()
    {
        $controlPoints = ControlPoint::with('fields')->get();
        return Excel::download(new ControlPointsExport($controlPoints), 'liste_des_points_de_contrôle.xlsx');
    }
}
