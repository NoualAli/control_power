<?php

namespace App\Console\Commands;

use App\Models\ControlCampaign;
use App\Models\User;
use App\Notifications\ControlCampaignNotification;
use Illuminate\Console\Command;

class sendControlCampaignNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'campaign:notify
                                {id? : control campaign id}
                                {created? : creation / edition mode}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notification for users about a specific control campaign';

    protected $concerned = ['cdc', 'dg', 'cdrcp'];

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
        try {
            $users = User::all()->filter(fn ($user) => hasRole($this->concerned, $user));
            if ($this->argument('id')) {
                $campaign =  ControlCampaign::find($this->argument('id'));
                $created = boolval($this->argument('created'));
                foreach ($users as $user) {
                    $user->notify(new ControlCampaignNotification($campaign, $created));
                }
            } else {
                $campaigns =  ControlCampaign::all()->filter(fn ($campaign) => $campaign->remaining_days_before_start <= 5);
                foreach ($campaigns as $campaign) {
                    foreach ($users as $user) {
                        $user->notify(new ControlCampaignNotification($campaign));
                    }
                }
            }
            $this->info('Tous les utilisateurs ont été notifiés avec succès');
        } catch (\Throwable $th) {
            $this->error($th->getMessage());
        }
        return 0;
    }
}