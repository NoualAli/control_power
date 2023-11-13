<?php

namespace App\Exports;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithProperties;

class FamiliesExport extends BaseExport implements FromView, WithProperties, ShouldAutoSize
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
        $families = $this->data;
        return view('export.families', compact('families'));
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
            'title'          => 'Liste des familles',
            'description'    => 'Liste des familles ControlPower',
            'subject'        => 'Liste des familles',
            'keywords'       => 'families,export,spreadsheet,excel',
            'category'       => 'Families',
            'manager'        => 'Noual Ali - noualdev@gmail.com',
            'company'        => 'Banque Nationale d\'Algérie (BNA)',
        ];
    }
}
