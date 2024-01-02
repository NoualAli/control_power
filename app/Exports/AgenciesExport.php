<?php

namespace App\Exports;

use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithProperties;

class AgenciesExport extends BaseExport implements FromView, WithProperties, ShouldAutoSize
{

    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        $agencies = $this->data;
        return view('export.agencies', compact('agencies'));
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
            'title'          => 'Liste des agences',
            'description'    => 'Liste des agences ControlPower',
            'subject'        => 'Liste des agences',
            'keywords'       => 'agencies,export,spreadsheet,excel',
            'category'       => 'Agencies',
            'manager'        => 'Noual Ali - noualdev@gmail.com',
            'company'        => 'Banque Nationale d\'Algérie (BNA)',
        ];
    }
}