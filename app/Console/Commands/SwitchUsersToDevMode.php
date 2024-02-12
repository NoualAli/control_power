<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SwitchUsersToDevMode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users-devmode';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update users password to default 123456';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if (env('APP_ENV') !== 'production' && env('APP_ENV') !== 'production-test') {
            try {
                $total = DB::table('users')->update([
                    'password' => Hash::make('123456')
                ]);
                if ($total) {
                    $total = $total > 1 ? $total . ' lignes ont étaient mise à jour' : $total . ' ligne mise à jour a été mise à jour';
                    return $this->info('Commande éxecuter avec succès ' . $total);
                }
                return $this->info('Aucune ligne n\'a été mise à jour');
            } catch (\Throwable $th) {
                $this->error($th->getMessage());
            }
        } else {
            return $this->error('Cette commande n\'est pas autorisée dans un environement de production ou de pre-production');
        }
    }
}
