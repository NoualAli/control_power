<?php

namespace App\Exports;

use App\Enums\EventLogTypes;
use App\Models\EventLog;
use App\Models\Process;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithProperties;

class ProcessesExport extends BaseExport implements FromView, WithProperties, ShouldAutoSize
{

    /**
     * @var Illuminate\Support\Collection
     */
    private $data;

    public function __construct(Collection $data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        EventLog::store(['type' => EventLogTypes::EXPORT, 'attachable_type' => Process::class]);
        $processes = $this->data;
        return view('export.processes', compact('processes'));
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
            'title'          => 'Liste des processus',
            'description'    => 'Liste des processus ControlPower',
            'subject'        => 'Liste des processus',
            'keywords'       => 'processes,export,spreadsheet,excel',
            'category'       => 'Processes',
            'manager'        => 'Noual Ali - noualdev@gmail.com',
            'company'        => 'Banque Nationale d\'Algérie (BNA)',
        ];
    }
}
