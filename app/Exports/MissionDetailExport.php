<?php

namespace App\Exports;

use App\Enums\EventLogTypes;
use App\Models\EventLog;
use App\Models\MissionDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithProperties;

class MissionDetailExport extends BaseExport implements FromView, WithProperties, ShouldAutoSize
{
    private $details;
    private $missionReference;

    public function __construct($details)
    {
        $this->details = $details;
        $missionReference = DB::table('missions')->select('reference')->where('id', request('mission'))->first()?->reference;
        $missionReference = $missionReference ? str_replace('/', '-', $missionReference) : null;
        $this->missionReference = $missionReference;
    }

    public function view(): View
    {
        $details = $this->details;
        $details->map(function ($detail) {
            $controlPoint = DB::table('control_points')->select('scores')->where('id', $detail->control_point_id)->first();
            $appreciation = collect(json_decode($controlPoint->scores))->filter(fn ($score) => $score[0]->score == $detail->score)->first();
            $detail->appreciation = isset($appreciation[1]) ? $appreciation[1]?->label : null;
            $observation = DB::table('comments')->where('commentable_type', MissionDetail::class)->where('commentable_id', $detail->id)->whereIn('type', ['ci_observation', 'cdc_observation'])
                ->orderBy('created_at', 'DESC')->first();
            $detail->observation = $observation->content;
            return $detail;
        });
        $missionReference = $this->missionReference;
        EventLog::store(['type' => EventLogTypes::EXPORT, 'attachable_type' => MissionDetail::class, 'payload' => ['content' => 'Détails de la mission ' . $missionReference]]);
        return view('export.mission_details', compact('details', 'missionReference'));
    }

    /**
     * Set file properties
     *
     * @return array
     */
    public function properties(): array
    {
        return [
            'creator'        => env('APP_NAME'),
            'lastModifiedBy' => env('APP_NAME'),
            'title'          => 'Liste des détails',
            'description'    => 'Liste des détails ControlPower',
            'subject'        => 'Liste des détails',
            'keywords'       => 'details,export,spreadsheet,excel',
            'category'       => 'details',
            'manager'        => 'Noual Ali - noualdev@gmail.com',
            'company'        => 'Banque Nationale d\'Algérie (BNA)',
        ];
    }
}
