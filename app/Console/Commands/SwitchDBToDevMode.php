<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SwitchDBToDevMode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:devmode';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove all entries from concerned table';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if (env('APP_ENV') !== 'production' && env('APP_ENV') !== 'production-test') {
            try {
                DB::transaction(function () {
                    DB::table('mission_has_controllers')->delete();
                    DB::table('mission_detail_regularizations')->delete();
                    DB::table('mission_details')->delete();
                    DB::table('missions')->delete();
                    DB::table('control_campaign_processes')->delete();
                    DB::table('control_campaigns')->delete();
                    DB::table('comments')->delete();
                    DB::table('notifications')->delete();
                    $this->info('Base de données réinitialisée avec succès');
                });
            } catch (\Throwable $th) {
                $this->error($th->getMessage());
            }
        } else {
            return $this->error('Cette commande n\'est pas autorisée dans un environement de production ou de pre-production');
        }
    }
}
