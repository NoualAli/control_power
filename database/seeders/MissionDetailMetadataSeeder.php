<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MissionDetailMetadataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            $details = DB::table('mission_details')
                ->select('metadata', 'id')->whereNotNull('metadata')->get();
            foreach ($details as $detail) {
                $metadata = json_decode($detail->metadata);
                if (is_array($metadata) && count($metadata)) {
                    $metadata = array_map(function ($lines) use ($detail) {
                        return array_map(function ($line) use ($detail) {
                            if ($line) {
                                if (!property_exists($line, 'label') || !property_exists($line, 'value') || !property_exists($line, 'key') || !property_exists($line, 'id') || !property_exists($line, 'is_multiple') || !property_exists($line, 'is_major_fact')) {
                                    $key = array_key_first(collect($line)->toArray());
                                    $value = $line->$key;
                                    $label = $line->label;
                                    $field = DB::table('fields')->where('name', $key)->first()?->id;
                                    if (!$field) {
                                        if ($key == 'numero_dossier_remise_documentaire') {
                                            $label = 'N° de dossier de remise documentaire';
                                        } else {
                                            $label = $line->label;
                                        }
                                        $field = DB::table('fields')->insertGetId([
                                            'type' => 'text',
                                            'label' => $label,
                                            'name' => $key,
                                            'placeholder' => null,
                                            'help_text' => null,
                                            'columns' => 12,
                                            'options' => null,
                                            'min_length' => 0,
                                            'max_length' => null,
                                            'required' => false,
                                            'distinct' => false,
                                            'is_integer_or_float' => false,
                                            'is_multiple' => false,
                                            'additional_rules' => null,
                                        ]);
                                    }
                                    $line = [
                                        'key' => $key,
                                        'value' => $value,
                                        'label' => $label,
                                        'id' => $field,
                                        'is_multiple' => false,
                                        'is_major_fact' => false,
                                        'rowId' => $detail->id
                                    ];

                                    return $line;
                                } else {
                                    return $line;
                                }
                            }
                        }, $lines);
                    }, $metadata);
                }
                DB::table('mission_details')->where('id', $detail->id)->update(['metadata' => json_encode($metadata)]);
            }
        });
    }
}
