<?php

namespace App\Exports;

use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithProperties;

class FieldExport extends BaseExport implements FromView, WithProperties, ShouldAutoSize
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        $fields = $this->data;
        return view('export.fields', compact('fields'));
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
            'title'          => 'Liste des champs supplémentaires',
            'description'    => 'Liste des champs supplémentaires ControlPower',
            'subject'        => 'Liste des champs supplémentaires',
            'keywords'       => 'champs supplémentaires,export,spreadsheet,excel',
            'category'       => 'Fields',
            'manager'        => 'Noual Ali - noualdev@gmail.com',
            'company'        => 'Banque Nationale d\'Algérie (BNA)',
        ];
    }
}
