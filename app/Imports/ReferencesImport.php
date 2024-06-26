<?php

namespace App\Imports;

use App\Models\Family;
use App\Models\Media;
use App\Models\Process;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ReferencesImport implements ToModel, WithHeadingRow
{

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $family = isset($row['familles']) && !empty($row['familles']) ? Family::where('name', trim($row['familles']))->first() : null;
        $domain = isset($row['domaines']) && !empty($row['domaines']) && $family?->id ? $family?->domains()->where('name', trim($row['domaines']))->first() : null;
        $process = isset($row['processus']) && !empty($row['processus']) && $domain?->id ? $domain?->processes()->where('name', trim($row['processus']))->first() : null;
        $type = isset($row['type']) && !empty($row['type']) && in_array($row['type'], ['Circulaire', 'Lettre-circulaire', 'Note', 'Guide 1er niveau']) ? ucfirst(strtolower($row['type'])) : null;
        // dd($row['familles'], $family, $row['domaines'], $domain, $row['processus'], $process, isset($row['domaines']) && !empty($row['domaines']) && $family?->id);
        if (!$family || !$domain || !$process) {
            dd($row, $family,  $domain, $process, $domain?->processes->pluck('name'));
        }
        // Check if family, domain, process and type are not null
        // to perform copy of file and store it into database
        try {
            if ($family !== null && $domain !== null && $process !== null && $type !== null) {
                $number = isset($row['numero']) && !empty($row['numero']) ? $row['numero'] : null;
                $date = isset($row['date']) && !empty($row['date']) ? Carbon::parse(str_replace('_', '-', $row['date'])) : null;
                if ($type == 'Guide 1er niveau') {
                    $date = null;
                    $file_name = $row['objet'];
                } else {
                    $file_name = $this->getFileName($type, $number, $date);
                }
                isset($row['date']) && !empty($row['date']) ? Carbon::parse(str_replace('_', '-', $row['date']))->format('d-m-Y') : null;
                $object = isset($row['objet']) && !empty($row['objet']) ? $row['objet'] : null;
                $hash_name = $this->getHashName($file_name);
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
                $full_path = 'data\\documents\\' . $type . '\\' . $file_name;
                $fileExtension = $this->getExtension($full_path);
                $full_path = 'data\\documents\\' . $type . '\\' . $file_name . '.' . $fileExtension;
                $full_path_hashed = $folder . '\\' . $hash_name . '.' . $fileExtension;
                $attachableType = Process::class;
                $attachableId = $process->id;
                if (!File::exists($full_path)) {
                    // dd($row, $full_path, $fileExtension);
                }
                if (File::exists($full_path)) {
                    File::copy(public_path($full_path), public_path($full_path_hashed));
                    $mimeType = File::mimeType($full_path_hashed);
                    $size = File::size($full_path_hashed);
                    // Insert into database
                    $media = Media::create([
                        'attachable_id' => $attachableId,
                        'attachable_type' => $attachableType,
                        'hash_name' => $hash_name . '.' . $fileExtension,
                        'original_name' => $file_name . '.' . $fileExtension,
                        'extension' => $fileExtension,
                        'folder' => $folder,
                        'mimetype' => $mimeType,
                        'size' => $size,
                        'payload' => json_encode([
                            'number' => $number,
                            'date' => $date,
                            'object' => $object,
                            'type' => $type,
                        ])
                    ]);
                }
            }
        } catch (\Throwable $th) {
            dd($th->getMessage(), $th->getLine(), $row);
        }
    }

    /**
     * Get file extension
     *
     * @param string $path
     *
     * @return string
     */
    private function getExtension(string $path): string
    {
        $extensions = ['tif', 'pdf', 'png', 'jpg'];
        $fileExtension = '';
        foreach ($extensions as $extension) {
            // dd(File::exists($path . '.' . $extension), $path, $extension);
            if (File::exists($path . '.' . $extension)) {
                $fileExtension = $extension;
                break;
            }
        }
        return $fileExtension;
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

    /**
     * Generate file name from specified attributes
     *
     * @param string|null $type
     * @param int|null $number
     * @param Carbon $date
     *
     * @return string
     */
    private function getFileName(?string $type, ?string $number, ?Carbon $date): string
    {
        $file_name = '';
        if ($type) {
            $file_name .= $type;
        }
        if ($number) {
            $file_name .= ' N°' . $number;
        }

        if ($date) {
            $file_name .= ' du ' . $date->format('d-m-Y');
        }

        return $file_name;
    }
}
