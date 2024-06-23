<?php

namespace App\Exports;

use App\Enums\EventLogTypes;
use App\Models\EventLog;
use App\Models\Process;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithProperties;

class ProcessControlPointsExport extends BaseExport implements FromView, WithProperties, ShouldAutoSize
{

    /**
     * @var App\Models\Process
     */
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        $controlPoints = getControlPoints()->where('p.id', $this->data->id)->get();
        $process = $this->data;
        EventLog::store(['type' => EventLogTypes::EXPORT, 'attachable_type' => Process::class, 'attachable_id' => $process->id, 'payload' => ['content' => 'Liste de points de contrôles du processus ' . $process->name]]);
        return view('export.control_points', compact('controlPoints', 'process'));
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
