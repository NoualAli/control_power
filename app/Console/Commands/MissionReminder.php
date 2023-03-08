<?php

namespace App\Console\Commands;

use App\Models\Mission;
use App\Models\controller;
use App\Notifications\Mission\Reminder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class MissionReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:mission {id? : mission id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email reminder about mission for concerned controllers';

    /**
     * Concerned controllers
     *
     * @var array
     */
    protected $concerned = ['ci'];

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            if ($this->argument('id')) {
                $mission =  Mission::find($this->argument('id'));
                $controllers = $mission->agencyControllers;
                foreach ($controllers as $controller) {
                    Notification::send($controller, new Reminder($mission));
                }
            } else {
                $missions =  Mission::all()->filter(fn ($mission) => $mission->remaining_days_before_start <= 5);
                foreach ($missions as $mission) {
                    $controllers = $mission->agencyControllers;
                    foreach ($controllers as $controller) {
                        Notification::send($controller, new Reminder($mission));
                    }
                }
            }
            $this->info('Tous les contrôleurs ont été notifiés avec succès');
            return Command::SUCCESS;
        } catch (\Throwable $th) {
            $this->error($th->getMessage());
        }
        return;
    }
}
