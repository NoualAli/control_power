<?php

namespace App\Http\Controllers\Api\V1\Mission;

use App\Enums\EventLogTypes;
use App\Enums\MissionState;
use App\Exports\MissionDetailExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Mission\Detail\ControlRequest;
use App\Models\EventLog;
use App\Models\MissionDetail;
use App\Models\User;
use App\Notifications\Mission\MajorFact\Detected;
use App\Services\ExcelExportService;
use App\Traits\UploadFiles;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class MissionDetailController extends Controller
{
    use UploadFiles;

    /**
     * @return Illuminate\Http\JsonResponse
     */
    public function export()
    {
        isAbleOrAbort(['view_mission_detail']);

        $export = request('export', []);
        try {

            $mission = getMissions(request('mission'), 2);
            $details = getMissionDetails($mission->id);
            $missionReference = $mission->reference ? '-' . str_replace('/', '-', $mission->reference) . '-' : null;
            $filename = 'détails_de_mission-' . $mission->campaign . $missionReference . Str::slug($mission->dre . '-' . $mission->agency) . '.xlsx';
            $details = getMissionDetails($mission->id);
            return (new ExcelExportService($details, MissionDetailExport::class, $filename, $export))->download();
        } catch (\Throwable $th) {
            return throwedError($th);
        }
    }

    private function details()
    {
        $details = MissionDetail::with([
            'controlPoint'  => fn ($query) => $query->with(['process'  => fn ($query) => $query->with(['domain'  => fn ($query) => $query->with('family')])]),
            'agency'  => fn ($query) => $query->with('dre'),
            'mission' => fn ($query) => $query->with(['campaign'])
        ]);

        $user = auth()->user();
        if (hasRole('dcp')) {
            $details = $details->hasCdcValidation();
        } elseif (hasRole('cdcr')) {
            $details = $details->hasCdcValidation();
        } elseif (hasRole(['cdc', 'cc', 'ci'])) {
            $details = $user->details()->controlled();
        } elseif (hasRole(['dg', 'cdrcp', 'der', 'cder', 'deac', 'dga'])) {
            $details = $details->hasDcpValidation();
        } elseif (hasRole('dre')) {
            $details = $user->details()->hasDcpValidation();
        } elseif (hasRole('da')) {
            $details = $user->details()->hasDcpValidation();
        } else {
            $details = $details;
        }
        return $details->whereAnomaly()->withoutMajorFacts();
    }
    /**
     * Enregistre les informations de la mission dans la base de donéees
     *
     * @param ControlRequest $request
     *
     * @return Illuminate\Http\Response
     */
    public function control(ControlRequest $request)
    {
        $data = $request->validated();
        $files = $data['media'];
        unset($data['media']);
        $data['metadata'] = isset($data['metadata']) ? array_map(function ($lines) {
            return array_map(function ($line) {
                $key = $line['key'];
                $value = $line['value'];
                $line[$key] = $value;
                return $line;
            }, $lines);
        }, $data['metadata']) : [];
        $this->handleMetadata($data);
        $data['metadata'] = count($data['metadata']) ? json_encode($data['metadata']) : null;
        try {
            DB::transaction(function () use ($data, $files) {
                $detail = MissionDetail::findOrFail($data['detail']);
                if (hasRole(['cdc', 'ci'])) {
                    if ($detail->observations()->count() && $detail->observations->first()->created_by_id == auth()->user()->id) {
                        $detail->observations->first()->update([
                            'content' => $data['report'],
                        ]);
                    } else {
                        $detail->observations()->create([
                            'content' => $data['report'],
                            'created_by_id' => auth()->user()->id,
                            'type' => auth()->user()->role->code . '_observation',
                            'creator_full_name' => getUserFullNameWithRole(),
                        ]);
                    }
                }
                unset($data['detail'], $data['report']);

                $this->updateDetail($data, $detail);
            });
            return response()->json([
                'message' => 'Les renseignements sur le point de contrôle sont sauvegardés avec succès.',
                'status' => true,
            ]);
        } catch (\Throwable $th) {
            return throwedError($th);
        }
    }

    /**
     * @param MissionDetail $detail
     *
     * @return
     */
    public function show(MissionDetail $detail)
    {
        $detail->unsetRelations();
        // $diffInDays = Carbon::parse($detail->mission->dcp_validation_at)->diffInDays(today());
        // $diffInWeeks = Carbon::parse($detail->mission->dcp_validation_at)->diffInWeekdays(today());
        // $detail->show_regularizations = (
        //     $detail->mission->is_validated_by_dcp &&
        //     (($diffInDays > (($diffInWeeks * 2) + 10) || $detail->mission->is_validated_by_da) || ((hasRole(['da', 'cdc', 'ci']) && in_array($detail->mission->agency_id, auth()->user()->agencies->pluck('id')->toArray()))) || hasRole('der'))
        // );
        $detail->show_regularizations = true;
        $detail->observation = $detail->observations()->count() ? $detail->observations()->first() : null;
        if ($detail->show_regularizations) {
            $detail->load('regularizations');
        }

        $detail->load('mission', 'media', 'dre', 'agency', 'campaign', 'family', 'domain', 'process', 'controlPoint', 'controlPoint.fields');
        return $detail;
    }

    /**
     * @param array $data
     * @param bool $multiple
     * @param null $rowKey
     *
     * @return void
     */
    private function handleMetadata(array $data, $multiple = false, $rowKey = null)
    {
        if (count($data['metadata'])) {
            foreach ($data['metadata'] as $rowKey => $row) {
                $fields = DB::table('mission_details', 'md')
                    ->select('f.*')
                    ->leftJoin('control_points AS cp', 'md.control_point_id', 'cp.id')
                    ->leftJoin('has_fields AS hf', 'cp.id', 'hf.attachable_id')
                    ->leftJoin('fields AS f', 'hf.field_id', 'f.id')
                    ->where('attachable_type', 'App\Models\ControlPoint')
                    ->where('md.id', $data['detail'])
                    ->get();
                if ($fields->count()) {
                    validateFields($fields, $data, $multiple, $rowKey);
                }
            }
        }
    }


    /**
     * Notify  concerned users
     *
     * @param App\Models\MissionDetail $detail
     * @param array $roles
     */
    private function notifyMajorFact(MissionDetail $detail): void
    {
        if ($detail->major_fact) {
            $users = collect([]);
            if (hasRole('ci')) {
                $users = $users->push($detail->mission->creator);
            } elseif (hasRole(['cdc', 'cc'])) {
                $users = User::whereRoles(['cdcr', 'dcp'])->isActive()->get();
            } elseif (hasRole('cdcr')) {
                $users = User::whereRoles(['dcp'])->isActive()->get();
            } elseif (hasRole('dcp')) {
                $users = User::whereRoles(['dg', 'sg', 'ig', 'dga', 'der', 'deac'])->isActive()->get();
            }
            foreach ($users as $user) {
                if (!$user->notifications()->where('data->detail_id', $detail->id)->count()) {
                    Notification::send($user, new Detected($detail));
                }
            }
        }
    }

    /**
     * Update mission detail
     *
     * @param array $data
     * @param App\Models\MissionDetail $detail
     *
     * @return App\Models\MissionDetail
     */
    private function updateDetail(array $data, MissionDetail $detail)
    {
        return DB::transaction(function () use ($detail, $data) {
            $oldDetail = clone $detail;
            $oldMajorFactValue = $detail->major_fact;
            $currentMode = $data['currentMode'];
            $type = $detail->score ? EventLogTypes::UPDATE : EventLogTypes::CONTROL;
            if (!hasRole('ci')) {
                $type = EventLogTypes::UPDATE;
            }
            // Vidé les champs report, recovery_plan, metadata
            if (isset($data['score']) && $data['score'] == 1) {
                $data['recovery_plan'] = null;
            }

            $reportColumn = null;

            $newData = [
                'score' => isset($data['score']) ? $data['score'] : $detail->score,
                'recovery_plan' => isset($data['recovery_plan']) ? $data['recovery_plan'] : null,
                'metadata' => $data['metadata'],
            ];

            if ($reportColumn) {
                $newData[$reportColumn] = isset($data['report']) ? $data['report'] : $detail->report;
            }
            $userFullName = getUserFullNameWithRole();
            if (hasRole('ci')) {
                $newData['controlled_by_ci_at'] = now();
                $newData['controlled_by_ci_id'] = auth()->user()->id;
            } elseif (hasRole('cdc')) {
                $newData['controlled_by_cdc_at'] = now();
                $newData['controlled_by_cdc_id'] = auth()->user()->id;
                $newData['cdc_full_name'] = $userFullName;
            } elseif (hasRole('cc')) {
                $newData['controlled_by_cc_at'] = now();
                $newData['controlled_by_cc_id'] = auth()->user()->id;
            } elseif (hasRole('cdcr')) {
                $newData['controlled_by_cdcr_at'] = now();
                $newData['controlled_by_cdcr_id'] = auth()->user()->id;
                $newData['cdcr_full_name'] = $userFullName;
            } elseif (hasRole('dcp')) {
                $newData['controlled_by_dcp_at'] = now();
                $newData['controlled_by_dcp_id'] = auth()->user()->id;
                $newData['dcp_full_name'] = $userFullName;
            } else {
                abort(404, 'Le rôle de l\'utilisateur n\'est pas pri en charge.');
            }

            // Gérer le fait majeur
            if (isset($data['major_fact']) && !empty($data['major_fact']) && $data['major_fact'] && !$detail->major_fact) {
                $newData['major_fact'] = $data['major_fact'];
                $newData['major_fact_is_rejected_at_dre'] = false;
                $newData['major_fact_is_rejected_at_dcp'] = false;
                $newData['major_fact_is_detected_by_full_name'] = $userFullName;
                $newData['major_fact_is_detected_by_id'] = auth()->user()->id;
                $newData['major_fact_is_detected_at'] = now();

                if (hasRole(['cdc', 'cc', 'cdcr'])) {
                    $newData['major_fact_is_dispatched_to_dcp_at'] = now();
                    $newData['major_fact_is_dispatched_to_dcp_by_full_name'] = $userFullName;
                    $newData['major_fact_is_dispatched_to_dcp_by_id'] = auth()->user()->id;
                } elseif (hasRole(['dcp'])) {
                    $newData['major_fact_is_dispatched_at'] = now();
                    $newData['major_fact_is_dispatched_by_full_name'] = $userFullName;
                    $newData['major_fact_is_dispatched_by_id'] = auth()->user()->id;
                }
            }
            $detail->update($newData);
            EventLog::store(['type' => $type, 'attachable_type' => MissionDetail::class, 'attachable_id' => $detail->id, 'payload' => ['old' => $oldDetail, 'new' => $detail]]);

            // Mise à jour de la date réel du début de la mission
            if ($currentMode == 1 && !$detail->mission->real_start && $detail->mission->details()->controlled()->count() == 1) {
                $detail->mission->update(['real_start' => now(), 'current_state' => MissionState::ACTIVE]);
            }

            if ($detail->major_fact && !$oldMajorFactValue) {
                $this->notifyMajorFact($detail);
            }

            return $detail;
        });
    }
}