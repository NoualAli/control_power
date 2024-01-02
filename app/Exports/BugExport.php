<?php

namespace App\Exports;

use Illuminate\View\View;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithProperties;

class BugExport extends BaseExport implements FromView, WithProperties, ShouldAutoSize
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
        $bugs = $this->data;
        return view('export.bugs', compact('bugs'));
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
            'title'          => 'Liste des bugs',
            'description'    => 'Liste des bugs ControlPower',
            'subject'        => 'Liste des bugs',
            'keywords'       => 'bugs,export,spreadsheet,excel',
            'category'       => 'Bugs',
            'manager'        => 'Noual Ali - noualdev@gmail.com',
            'company'        => 'Banque Nationale d\'Algérie (BNA)',
        ];
    }
}
