<?php

namespace App\Console\Commands;

use App\Models\Mission;
use App\Models\User;
use App\Notifications\Mission\Validated;
use App\Notifications\MissionValidatedNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

// namespace App\Notifications\MissionValidatedNotification;

class MissionValidated extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mission:validated {id} {user_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify user that mission is validated';

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
        $user = User::findOrFail($this->argument('user_id'));
        $mission = Mission::findOrFail($this->argument('id'));
        try {
            Notification::send($user, new Validated($mission));
        } catch (\Throwable $th) {
            $this->error($th->getMessage());
        }
        return Command::SUCCESS;
    }
}
