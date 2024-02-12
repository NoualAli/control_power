<?php

namespace App\Exports;

use App\Enums\EventLogTypes;
use App\Models\EventLog;
use App\Models\Mission;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithProperties;

class MissionsExport extends BaseExport implements FromView, WithProperties, ShouldAutoSize
{
    /**
     * @var Illuminate\Database\Eloquent\Collection
     */
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        EventLog::store(['type' => EventLogTypes::EXPORT, 'attachable_type' => Mission::class]);
        $missions = $this->data;
        return view('export.missions', compact('missions'));
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
            'title'          => 'Liste des missions',
            'description'    => 'Liste des missions ControlPower',
            'subject'        => 'Liste des missions',
            'keywords'       => 'missions,export,spreadsheet,excel',
            'category'       => 'Missions',
            'manager'        => 'Noual Ali - noualdev@gmail.com',
            'company'        => 'Banque Nationale d\'Algérie (BNA)',
        ];
    }
}
