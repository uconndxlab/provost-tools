<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pt:admin {netid} {--remove}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Enable admin privileges for a netid.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user = User::where('netid', $this->argument('netid'))->first();

        if ( $this->option('remove') ) {
            $user->can_admin = false;
            $user->save();
            $this->info('Admin privileges removed for ' . $this->argument('netid') . '.');
        } else {
            $user->can_admin = true;
            $user->save();
            $this->info('Admin privileges granted for ' . $this->argument('netid') . '.');
        }
    }
}
