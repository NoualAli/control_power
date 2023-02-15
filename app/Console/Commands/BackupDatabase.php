<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class BackupDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:backup {driver?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $seeders = database_path('seeders');
        File::deleteDirectory($seeders);
        File::makeDirectory($seeders);

        $seederCreation = $this->call('make:seeder', ['name' => 'DatabaseSeeder']);
        if ($seederCreation === 0) {
            $database = env('DB_DATABASE');
            $tables = collect(Schema::getAllTables())->pluck('Tables_in_' . $database)->filter(fn ($table) => $table !== 'migrations' && $table !== 'password_resets')->toArray();
            $tables = implode(',', $tables);
            $driver = $this->argument('driver') ?: 'iseed';
            $state = 0;
            if ($driver == 'iseed') {
                $state = $this->call('iseed', compact('tables'));
            }

            if ($state === 0) {
                $this->info('Backup effectuer avec succès');
            } else {
                $this->error('Une erreur est survenu lors du backup de la base de données');
            }
        } else {
            $this->error('Une erreur est survenu lors de la création du fichier DatabaseSeeder');
        }
        return 0;
    }
}
