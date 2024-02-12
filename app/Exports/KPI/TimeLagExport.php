<?php

namespace App\Exports\KPI;

use App\Enums\EventLogTypes;
use App\Exports\BaseExport;
use App\Models\EventLog;
use App\Models\User;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithProperties;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TimeLagExport extends BaseExport implements FromView, WithProperties, ShouldAutoSize
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        EventLog::store(['type' => EventLogTypes::EXPORT, 'attachable_type' => User::class, 'payload' => ['content' => 'KPI timeLag']]);
        $data = $this->data;
        return view('export.kpi.time_lag', compact('data'));
    }

    public function styles(Worksheet $sheet)
    {
        $highestColumn = $sheet->getHighestColumn();
        $highestRow = $sheet->getHighestRow();

        // Set cell background and text color based on score
        $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);

        for ($row = 2; $row <= $sheet->getHighestRow(); $row++) {
            for ($colIndex = 10; $colIndex <= $highestColumnIndex; $colIndex++) {
                $formCol = $colIndex - 1;
                $col = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($formCol);
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
                $cellValue = intval(str_replace('%', '', $cellValue));
                if ($cellValue < 25) {
                    $style['fill']['startColor']['argb'] = 'FF00C851'; // success
                    $style['font']['color']['argb'] = 'FFFFFFFF';
                    $style['font']['bold'] = true;
                } else if ($cellValue == 25) {
                    $style['fill']['startColor']['argb'] = 'FF33B5E5'; // info
                    $style['font']['color']['argb'] = 'FFFFFFFF';
                } elseif ($cellValue <= 50 && $cellValue > 25) {
                    $style['fill']['startColor']['argb'] = 'FFFFBB33'; // warning
                    $style['font']['color']['argb'] = 'FF333333';
                } elseif ($cellValue > 50) {
                    $style['fill']['startColor']['argb'] = 'FFFF4444'; // danger
                    $style['font']['color']['argb'] = 'FFFFFFFF';
                }
                $sheet->getStyle('J' . $row)->applyFromArray($style);
            }
        }

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
            1 => ['font' => ['bold' => true], 'alignment' => ['vertical' => 'center']],
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
            'title'          => 'Taux d\'Accomplissement des Missions Hors Délais par les contrôleurs',
            'description'    => "Ce KPI quantifie la proportion des missions de contrôle qui, bien que réussies, n'ont pas été finalisées dans les délais prédéfinis. Il vise à mettre en évidence les éventuels retards dans l'exécution des missions et à identifier les zones d'amélioration en matière de gestion du temps.",
            'subject'        => 'KPI',
            'keywords'       => 'kpi,export,spreadsheet,excel',
            'category'       => 'KPI',
            'manager'        => 'Noual Ali - noualdev@gmail.com',
            'company'        => 'Banque Nationale d\'Algérie (BNA)',
        ];
    }
}
