<?php

namespace App\Exports;

use App\Enums\EventLogTypes;
use App\Models\ControlCampaign;
use App\Models\EventLog;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithProperties;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SynthesisWithReportsExport implements FromView, WithStyles, WithProperties
{
    /**
     * @var array
     */
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        EventLog::store(['type' => EventLogTypes::EXPORT, 'attachable_type' => ControlCampaign::class, 'attachable_id' => $this->data['controlCampaign']->id, 'payload' => ['Syntèse de campagne de contrôle avec constats et plans de redressement']]);
        return view('export.synthesis_reports_to_excel', $this->data);
    }

    public function styles(Worksheet $sheet)
    {
        $highestColumn = $sheet->getHighestColumn();
        $highestRow = $sheet->getHighestRow();

        // Set cell background and text color based on score
        $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);

        for ($row = 3; $row <= $sheet->getHighestRow(); $row++) {
            for ($colIndex = 5; $colIndex <= $highestColumnIndex; $colIndex++) {
                $col = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIndex);
                $cellValue = $sheet->getCell($col . $row)->getValue();
                $style = [
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['argb' => 'FFFCFCFC'],
                    ],
                    'font' => [
                        'color' => ['argb' => 'FF000000'],
                    ],
                ];

                if ($cellValue >= 1 && $cellValue < 2 && is_numeric($cellValue)) {
                    $style['fill']['startColor']['argb'] = 'FF00C851';
                    $style['font']['color']['argb'] = 'FFFFFFFF';
                } else if ($cellValue >= 2 && $cellValue < 3 && is_numeric($cellValue)) {
                    $style['fill']['startColor']['argb'] = 'FF33b5e5';
                    $style['font']['color']['argb'] = 'FFFFFFFF';
                } elseif ($cellValue >= 3 && $cellValue < 4 && is_numeric($cellValue)) {
                    $style['fill']['startColor']['argb'] = 'FFFFbb33';
                    $style['font']['color']['argb'] = 'FF333333';
                } elseif ($cellValue == 4 && is_numeric($cellValue)) {
                    $style['fill']['startColor']['argb'] = 'FFFF4444';
                    $style['font']['color']['argb'] = 'FFFFFFFF';
                } elseif ($cellValue == '-' || is_null($cellValue) || empty($cellValue)) {
                    $style['fill']['startColor']['argb'] = 'D9D9D9';
                    $style['font']['color']['argb'] = '363636';
                }

                $sheet->getStyle($col . $row)->applyFromArray($style);
            }
        }

        $sheet->getStyle('E3:' . $sheet->getHighestColumn() . $sheet->getHighestRow())
            ->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Apply border styles to the entire worksheet
        $cellRange = 'A1:' . $highestColumn . $highestRow;
        $sheet->getStyle($cellRange)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF333333'],
                ],
            ],
        ]);

        return [
            1 => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
            2 => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
            3 => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
        ];
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
            'title'          => 'Récapitulatif des constats ' . $this->data['controlCampaign']->reference,
            'description'    => 'Récapitulatif des constats de la campagne de contrôle ' . $this->data['controlCampaign']->reference,
            'subject'        => 'Récapitulatif des constats',
            'keywords'       => 'Récapitulatif des constats,export,spreadsheet,excel',
            'category'       => 'Récapitulatif des constats',
            'manager'        => 'Noual Ali - noualdev@gmail.com',
            'company'        => 'Banque Nationale d\'Algérie (BNA)',
        ];
    }
}
