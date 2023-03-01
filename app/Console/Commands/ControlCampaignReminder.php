<?php

namespace App\Console\Commands;

use App\Models\ControlCampaign;
use App\Models\User;
use App\Notifications\ControlCampaign\Reminder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class ControlCampaignReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:campaign {id? : control campaign id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email reminder about control campaign for concerned users';

    /**
     * Concerned users
     *
     * @var array
     */
    protected $concerned = ['cdc', 'cdcr', 'dre', 'ci', 'dcp'];

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $users = User::whereRoles($this->concerned)->get();
            if ($this->argument('id')) {
                $campaign =  ControlCampaign::find($this->argument('id'));
                foreach ($users as $user) {
                    Notification::send($user, new Reminder($campaign));
                }
            } else {
                $campaigns =  ControlCampaign::all()->filter(fn ($campaign) => $campaign->remaining_days_before_start <= 5);
                foreach ($campaigns as $campaign) {
                    foreach ($users as $user) {
                        Notification::send($user, new Reminder($campaign));
                    }
                }
            }
            $this->info('Tous les utilisateurs ont été notifiés avec succès');
        } catch (\Throwable $th) {
            $this->error($th->getMessage());
        }

        return Command::SUCCESS;
    }
}
