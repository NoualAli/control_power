<?php

namespace App\Exports;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithProperties;

class ControlPointsExport extends BaseExport implements FromView, WithProperties, ShouldAutoSize
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
        $controlPoints = $this->data;
        return view('export.control_points', compact('controlPoints'));
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
            'title'          => 'Liste des points de contrôle',
            'description'    => 'Liste des points de contrôle ControlPower',
            'subject'        => 'Liste des points de contrôle',
            'keywords'       => 'control_points,pcf,export,spreadsheet,excel',
            'category'       => 'PCF',
            'manager'        => 'Noual Ali - noualdev@gmail.com',
            'company'        => 'Banque Nationale d\'Algérie (BNA)',
        ];
    }
}