<?php

namespace App\Imports;

use App\Models\ControlPoint;
use App\Models\Domain;
use App\Models\Familly;
use App\Models\Process;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ControlPointsImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // dd(Process::where('name', 'Pré domicliation et domiciliation')->first());
        $family = isset($row['familles']) && !empty($row['familles']) ? Familly::where('name', $row['familles'])->firstOrCreate(['name' => trim($row['familles'])]) : null;
        $domain = isset($row['domaine']) && !empty($row['domaine']) && $family?->id ? Domain::where('name', $row['domaine'])->where('familly_id', $family?->id)->firstOrCreate(['name' => trim($row['domaine']), 'familly_id' => $family?->id]) : null;
        $process = isset($row['processus']) && !empty($row['processus']) && $domain?->id ? Process::where('name', $row['processus'])->where('domain_id', $domain?->id)->firstOrCreate(['name' => trim($row['processus']), 'domain_id' => $domain?->id]) : null;
        try {
            DB::transaction(function ()  use ($row, $process) {
                if ($process->id) {
                    $name = trim($row['points_de_controle']);
                    $process_id = $process?->id;
                    $scores = isset($row['notations']) && !empty($row['notations']) ? json_decode($row['notations']) : null;
                    $fields = isset($row['metadonnees']) && !empty($row['metadonnees']) ? json_decode($row['metadonnees']) : null;
                    $has_major_fact = isset($row['faits_majeur']) && !empty($row['faits_majeur']) ? boolval($row['faits_majeur']) : false;

                    $data = compact('name', 'process_id', 'scores', 'fields', 'has_major_fact');
                    return ControlPoint::create($data);
                }
            });
        } catch (\Throwable $th) {
            dd($th->getMessage(), $th->getLine(), $row, $process);
        }
    }
}
