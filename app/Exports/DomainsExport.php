<?php

namespace App\Exports;

use App\Enums\EventLogTypes;
use App\Models\Domain;
use App\Models\EventLog;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithProperties;

class DomainsExport extends BaseExport implements FromView, ShouldAutoSize, WithProperties
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
        EventLog::store(['type' => EventLogTypes::EXPORT, 'attachable_type' => Domain::class]);
        $domains = $this->data;
        return view('export.domains', compact('domains'));
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
            'title'          => 'Liste des domaines',
            'description'    => 'Liste des domaines ControlPower',
            'subject'        => 'Liste des domaines',
            'keywords'       => 'domains,export,spreadsheet,excel',
            'category'       => 'Domains',
            'manager'        => 'Noual Ali - noualdev@gmail.com',
            'company'        => 'Banque Nationale d\'Algérie (BNA)',
        ];
    }
}
