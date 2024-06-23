<?php

namespace App\Exports;

use App\Enums\EventLogTypes;
use App\Models\Domain;
use App\Models\EventLog;
use App\Models\Process;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithProperties;

class DomainProcessesExport extends BaseExport implements FromView, WithProperties, ShouldAutoSize
{

    /**
     * @var App\Models\Domain
     */
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        $processes = getProcesses()->where('d.id', $this->data->id)->get();
        $domain = $this->data;
        EventLog::store(['type' => EventLogTypes::EXPORT, 'attachable_type' => Domain::class, 'attachable_id' => $domain->id, 'payload' => ['content' => 'Liste des processus du domaine ' . $domain->name]]);
        return view('export.processes', compact('processes', 'domain'));
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
            'title'          => 'Liste des rôles utilisateur',
            'description'    => 'Liste des rôles utilisateur ControlPower',
            'subject'        => 'Liste des rôles utilisateur',
            'keywords'       => 'roles,export,spreadsheet,excel',
            'category'       => 'Roles',
            'manager'        => 'Noual Ali - noualdev@gmail.com',
            'company'        => 'Banque Nationale d\'Algérie (BNA)',
        ];
    }
}
