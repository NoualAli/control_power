<?php

namespace App\Exports;

use App\Enums\EventLogTypes;
use App\Models\EventLog;
use App\Models\Structures\RegionalInspection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithProperties;

class RegionalInspectionDresExport extends BaseExport implements FromView, WithProperties, ShouldAutoSize
{
    /**
     * @var App\Models\Structures\RegionalInspection
     */
    private $data;

    public function __construct(RegionalInspection $data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        $dres = $this->data->dres()->withCount('agencies')->get();
        $regional_inspection = $this->data;
        EventLog::store(['type' => EventLogTypes::EXPORT, 'attachable_type' => RegionalInspection::class, 'attachable_id' => $regional_inspection->id, 'payload' => ['content' => 'Liste des agences ' . $regional_inspection->full_name]]);
        return view('export.regional_inspection_dres', compact('dres', 'regional_inspection'));
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
            'title'          => 'Liste des DRE de l\'inspection regionale ' . $this->data->full_name,
            'description'    => 'Liste des DRE de l\'inspection regionale ' . $this->data->full_name . ' ControlPower',
            'subject'        => 'Liste des DRE de l\'inspection regionale ' . $this->data->full_name,
            'keywords'       => 'DRE,regional_inspection,export,spreadsheet,excel',
            'category'       => 'Liste des DRE',
            'manager'        => 'Noual Ali - noualdev@gmail.com',
            'company'        => 'Banque Nationale d\'Algérie (BNA)',
        ];
    }
}
