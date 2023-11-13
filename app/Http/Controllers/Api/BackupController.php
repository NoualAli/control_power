<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BackupResource;
use Carbon\Carbon;
use DirectoryIterator;
use DragonCode\Support\Facades\Filesystem\File as FilesystemFile;
use DragonCode\Support\Filesystem\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use stdClass;

use function PHPUnit\Framework\directoryExists;
use function PHPUnit\Framework\fileExists;

class BackupController extends Controller
{
    public function index()
    {
        $path = database_path('bkps');
        $dir = new DirectoryIterator($path);
        $files = collect([]);
        $perPage = request('perPage', 10);
        foreach ($dir as $file) {
            if ($file->isFile()) {
                $single_file_info = new stdClass;
                $single_file_info->name = $file->getFilename();
                $single_file_info->size = formatBytes($file->getSize());
                $single_file_info->extension = $file->getExtension();
                $single_file_info->created_at = Carbon::parse($file->getCTime())->format('d-m-Y');
                $single_file_info->path = database_path('bkps/' . $file->getFilename());
                $files->push($single_file_info);
            }
        }
        $files = $files->sortBy('name');
        return BackupResource::collection(paginate($files, '/api/backup-db/', $perPage));
    }

    public function download(Request $request)
    {
        return response()->download(database_path('bkps/' . $request->filname));
    }

    public function store()
    {
        $databaseName = env('DB_DATABASE');
        $today = today()->format('d-m-Y');
        $filename = $databaseName . '_' . $today . '.bak';
        $backupPath = database_path('bkps\\' . $filename);
        $storageBackupPath = storage_path('app\bkps\\' . $filename);
        if (!directoryExists(storage_path('app\bkps'))) {
            mkdir(storage_path('app\bkps'));
        }

        if (file_exists($backupPath)) {
            unlink($backupPath);
        }

        $query = "BACKUP DATABASE [$databaseName] TO DISK = '$storageBackupPath' WITH NOFORMAT, NOINIT, NAME = N'control_power_prod-Complète Base de données Sauvegarde', SKIP, NOREWIND, NOUNLOAD, STATS = 10";
        Log::info("Backup file path: " . $storageBackupPath);
        try {
            $backup = DB::statement($query);

            if ($backup) {
                Log::info("Backup successful");
                // FilesystemFile::move($storageBackupPath, $backupPath);
                return response()->json([
                    'message' => 'Base de données sauvegardée avec succès',
                    'status' => true,
                ]);
            } else {
                return response()->json([
                    'message' => 'Une erreur est survenue lors de la tentative de sauvegarde de la base de données du fichier',
                    'status' => false,
                ]);
            }
        } catch (\Exception $e) {
            // Log the error for future reference
            Log::error("Backup failed. Error: " . $e->getMessage());

            return response()->json([
                'message' => 'Une erreur est survenue lors de la tentative de sauvegarde de la base de données du fichier\n' . $e->getMessage(),
                'status' => false,
            ]);
        }
    }

    public function destroy(Request $request)
    {
        $file = database_path('bkps/' . $request->filename);
        if (file_exists($file)) {
            try {
                if (unlink($file)) {
                    return response()->json([
                        'message' => 'Fichier supprimer avec succès',
                        'status' => true,
                    ]);
                } else {
                    return response()->json([
                        'message' => 'Une erreur est survenue lors de la tentative de suppression du fichier',
                        'status' => false,
                    ]);
                }
            } catch (\Throwable $th) {
                return response()->json([
                    'message' => $th->getMessage(),
                    'status' => false,
                ]);
            }
        }
    }
}
