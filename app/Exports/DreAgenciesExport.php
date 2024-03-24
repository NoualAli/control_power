<?php

namespace App\Exports;

use App\Enums\EventLogTypes;
use App\Models\Structures\Agency;
use App\Models\Structures\Dre;
use App\Models\EventLog;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithProperties;

class DreAgenciesExport extends BaseExport implements FromView, WithProperties, ShouldAutoSize
{

    /**
     * @var App\Models\Structures\Dre
     */
    private $data;

    public function __construct(Dre $data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        $agencies = $this->data->agencies;
        $dre = $this->data;
        EventLog::store(['type' => EventLogTypes::EXPORT, 'attachable_type' => Dre::class, 'attachable_id' => $dre->id, 'payload' => ['content' => 'Liste des agences ' . $dre->full_name]]);
        return view('export.dre_agencies', compact('agencies', 'dre'));
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
            'title'          => 'Liste des agences de la DRE ' . $this->data->full_name,
            'description'    => 'Liste des agences de la DRE ' . $this->data->full_name . ' ControlPower',
            'subject'        => 'Liste des agences de la DRE ' . $this->data->full_name,
            'keywords'       => 'agences,dre,export,spreadsheet,excel',
            'category'       => 'Liste des agences',
            'manager'        => 'Noual Ali - noualdev@gmail.com',
            'company'        => 'Banque Nationale d\'Algérie (BNA)',
        ];
    }
}
