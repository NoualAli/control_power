<?php

namespace App\Exports;

use App\Enums\EventLogTypes;
use App\Models\EventLog;
use App\Models\Structures\RegionalInspection;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithProperties;

class RegionalInspectionsExport extends BaseExport implements FromView, WithProperties, ShouldAutoSize
{
    /**
     * @var Illuminate\Database\Eloquent\Collection
     */
    private $data;

    public function __construct(Collection $data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        EventLog::store(['type' => EventLogTypes::EXPORT, 'attachable_type' => RegionalInspection::class]);
        $regional_inspections = $this->data;
        return view('export.regional_inspections', compact('regional_inspections'));
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
            'title'          => 'Liste des inspections régionales',
            'description'    => 'Liste des inspections régionales ControlPower',
            'subject'        => 'Liste des inspections régionales',
            'keywords'       => 'inspections régionales,export,spreadsheet,excel',
            'category'       => 'Inspection régional',
            'manager'        => 'Noual Ali - noualdev@gmail.com',
            'company'        => 'Banque Nationale d\'Algérie (BNA)',
        ];
    }
}
