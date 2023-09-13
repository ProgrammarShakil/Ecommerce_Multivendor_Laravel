<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\NotifyInactiveUsers;
use Carbon\Carbon;
use Illuminate\Console\Command;

class EmailInactiveUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:email-inactive-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Email Inactive Users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $last_seven_days = Carbon::now()->subDay(7);
        $inactive_users = User::where('last_login', '<', $last_seven_days)->get();

        foreach($inactive_users as $user){
            $user->notify(new NotifyInactiveUsers);
        }
    }
}
