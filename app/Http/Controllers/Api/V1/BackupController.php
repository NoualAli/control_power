<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\BackupResource;
use Carbon\Carbon;
use DirectoryIterator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use stdClass;

use function PHPUnit\Framework\directoryExists;

class BackupController extends Controller
{
    public function index()
    {
        try {
            $path = database_path('bkps');
            $dir = new DirectoryIterator($path);
            $files = collect([]);
            $perPage = request('perPage', 10);
            foreach ($dir as $file) {
                if ($file->isFile()) {
                    $createdAt = Carbon::parse(Carbon::parse($file->getCTime()));
                    $single_file_info = new stdClass;
                    $single_file_info->name = $file->getFilename();
                    $single_file_info->size = formatBytes($file->getSize());
                    $single_file_info->created_at = $createdAt->format('d-m-Y');
                    $single_file_info->path = database_path('bkps/' . $file->getFilename());
                    $files->push($single_file_info);
                }
            }
            if (request('sort')) {
                foreach (request('sort') as $key => $value) {
                    $method = $value == 'desc' ? 'sortByDesc' : 'sortBy';
                    $files = $files->$method(function ($file) use ($key) {
                        return $file->$key;
                    });
                }
            } else {
                $files = $files->sortBy(function ($file) {
                    return $file->path;
                });
            }

            if (request('search')) {
                $files = $files->filter(fn ($file) => str_contains($file->name, request('search')));
            }

            return BackupResource::collection(paginate($files, '/api/backup-db/', $perPage));
        } catch (\Throwable $th) {
            return throwedError($th);
        }
    }

    public function download(Request $request)
    {
        return response()->download(database_path('bkps/' . $request->filname));
    }

    public function store()
    {
        $databaseName = env('DB_DATABASE');
        $serverName = env('DB_HOST');
        $username = env('DB_USERNAME');
        $password = env('DB_PASSWORD');
        $today = today()->format('d-m-Y');
        $backupFilePath = database_path('bkps/' . $today . '.bak');

        // Construct the command with proper quotes around the backup file path
        $command = "sqlcmd -S $serverName -U $username -P $password -Q \"BACKUP DATABASE [$databaseName] TO DISK='$backupFilePath'\"";

        try {
            // Execute the command
            if (file_exists($backupFilePath)) {
                unlink($backupFilePath);
            }
            $output = exec($command);
            return is_string($output) ? mb_convert_encoding($output, 'ISO-8859-1', 'UTF-8') : $output;
        } catch (\Exception $e) {
            // Log the error for future reference
            Log::error("Backup failed. Error: " . $e->getMessage());
            return throwedError($e);
        }
    }
    public function destroy(Request $request)
    {
        $file = database_path('bkps/' . $request->filename);
        if (file_exists($file)) {
            try {
                return actionResponse(unlink($file), 'Sauvegarde supprimer avec succès', 'Une erreur est survenue lors de la tentative de suppression du fichier');
            } catch (\Throwable $th) {
                return throwedError($th);
            }
        }
    }
}
