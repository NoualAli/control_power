<?php

namespace App\Imports;

use App\Models\Family;
use App\Models\Media;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DocImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $family = isset($row['famille']) && !empty($row['famille']) ? Family::where('name', trim($row['famille']))->first() : null;
        $domain = isset($row['domaine']) && !empty($row['domaine']) && $family?->id ? $family?->domains()->where('name', trim($row['domaine']))->first() : null;
        $type = isset($row['domain_file_type']) && !empty($row['domain_file_type']) && in_array($row['domain_file_type'], ['Fiche technique', 'Méthodologie']) ? ucfirst(strtolower($row['domain_file_type'])) : null;
        $file_name = isset($row['domain_file']) && !empty($row['domain_file']) ? trim($row['domain_file']) : null;
        // dd($row, $family, $domain, $type, $file_name);
        // if (!$family || !$domain) {
        //     dd($row, $family?->domains->pluck('name'),  $domain);
        // }
        // Check if family, domain and type
        // to perform copy of file and store it into database
        try {
            if ($family !== null && $domain !== null && $type !== null) {
                $hash_name = $this->getHashName(str_replace('.docx', '', $file_name));
                $folder = 'references\\' . $type;
                if (!File::exists($folder)) {
                    $folders = explode('\\', $folder);
                    $parentFolder = '';
                    foreach ($folders as $key => $value) {
                        $parentFolder .=  $key == 0 ?  $value : '\\' . $value;
                        if (!File::exists($parentFolder)) {
                            File::makeDirectory($parentFolder);
                        }
                    }
                }
                $fileExtension = 'docx';
                $full_path = 'archive\\' . $type . '\\' . $file_name;
                $full_path_hashed = $folder . '\\' . $hash_name . '.' . $fileExtension;
                $attachableType = Process::class;
                $attachableId = $domain->id;
                if (File::exists($full_path) && !File::exists($full_path_hashed)) {
                    File::copy(public_path($full_path), public_path($full_path_hashed));
                    $mimeType = File::mimeType($full_path_hashed);
                    $size = File::size($full_path_hashed);
                    // dd([
                    //     'attachable_id' => $attachableId,
                    //     'attachable_type' => $attachableType,
                    //     'hash_name' => $hash_name . '.' . $fileExtension,
                    //     'original_name' => $file_name,
                    //     'extension' => $fileExtension,
                    //     'folder' => $folder,
                    //     'mimetype' => $mimeType,
                    //     'size' => $size,
                    //     'payload' => json_encode([
                    //         'type' => $type,
                    //     ])
                    // ]);
                    // Insert into database
                    $media = Media::create([
                        'attachable_id' => $attachableId,
                        'attachable_type' => $attachableType,
                        'hash_name' => $hash_name . '.' . $fileExtension,
                        'original_name' => $file_name,
                        'extension' => $fileExtension,
                        'folder' => $folder,
                        'mimetype' => $mimeType,
                        'size' => $size,
                        'payload' => json_encode([
                            'type' => $type,
                        ])
                    ]);
                }
            }
        } catch (\Throwable $th) {
            dd($th->getMessage(), $th->getLine());
        }
    }

    /**
     * Generate a hash name for original name
     *
     * @param string $filename
     *
     * @return string
     */
    private function getHashName(string $filename): string
    {
        return str_replace(['/', '\\', '.'], '-', Hash::make($filename));
    }
}