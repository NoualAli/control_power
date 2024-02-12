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

class MissionsFallExport extends BaseExport implements FromView, WithProperties, ShouldAutoSize
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        EventLog::store(['type' => EventLogTypes::EXPORT, 'attachable_type' => User::class, 'payload' => ['content' => 'KPI missionsFall']]);
        $data = $this->data;
        return view('export.kpi.missions_fall', compact('data'));
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
            'title'          => 'Taux d\'Accomplissement des Missions par les contrôleurs',
            'description'    => "Ce KPI mesure la performance des contrôleurs au regard de la réalisation de leurs missions durant une campagne de contrôle. Il calcule le pourcentage des missions de contrôle validées avec succès par rapport au nombre total des missions assignées à un contrôleur. L'objectif est d'apprécier la diligence et la compétence des contrôleurs en matière de réalisation des missions, quelle que soit leur situation par rapport aux délais.",
            'subject'        => 'KPI',
            'keywords'       => 'kpi,export,spreadsheet,excel',
            'category'       => 'KPI',
            'manager'        => 'Noual Ali - noualdev@gmail.com',
            'company'        => 'Banque Nationale d\'Algérie (BNA)',
        ];
    }
}
