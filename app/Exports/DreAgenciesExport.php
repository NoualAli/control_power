<?php

namespace App\Exports;

use App\Models\Dre;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithProperties;

class DreAgenciesExport extends BaseExport implements FromView, WithProperties, ShouldAutoSize
{

    /**
     * @var App\Models\Dre
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
