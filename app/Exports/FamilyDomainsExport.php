<?php

namespace App\Exports;

use App\Enums\EventLogTypes;
use App\Models\Domain;
use App\Models\EventLog;
use App\Models\Family;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithProperties;

class FamilyDomainsExport extends BaseExport implements FromView, WithProperties, ShouldAutoSize
{

    /**
     * @var App\Models\Family
     */
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        $domains = getDomains()->where('f.id', $this->data->id)->get();
        $family = $this->data;
        EventLog::store(['type' => EventLogTypes::EXPORT, 'attachable_type' => Family::class, 'attachable_id' => $family->id, 'payload' => ['content' => 'Liste des domaines de la famille ' . $family->name]]);
        return view('export.domains', compact('domains', 'family'));
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
