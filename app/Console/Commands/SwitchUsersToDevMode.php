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
    protected $signature = 'devmode:users';

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
        DB::table('users')->update([
            'password' => Hash::make('123456')
        ]);
        return Command::SUCCESS;
    }
}
