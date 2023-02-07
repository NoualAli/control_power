<?php

namespace App\Console\Commands;

use App\Listeners\SendMajorFactDetectedNotification;
use App\Models\Mission;
use App\Models\MissionDetail;
use App\Models\User;
use App\Notifications\MajorFactDetectedNotification;
use Illuminate\Console\Command;

class MajorFactDetected extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'majorFact:detected {id : mission id} {user_id?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify concerned user';

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
        $detail = MissionDetail::findOrFail($this->argument('id'));
        if ($this->argument('user_id')) {
            $users = User::findOrFail($this->argument('user_id'));
        } else {
            $users = User::dcp();
        }
        foreach ($users as $user) {
            $user->notify(new MajorFactDetectedNotification($detail));
        }
        return 0;
    }
}
