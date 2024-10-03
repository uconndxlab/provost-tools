<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Ldap\LdapUser;

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

        if ( !$user ) {
            $this->info('User not found. Creating user.');
            $ldapUser = LdapUser::where('uid', $this->argument('netid'))->first();

            if ( $ldapUser ) {
                $user = User::create([
                    'netid' => $this->argument('netid'),
                    'name' => $ldapUser->cn[0],
                    'email' => $ldapUser->mail[0],
                    // 'emplid' => $ldapUser->employeeNumber[0], // Not in our LDAP attribute set currently
                    'affiliation' => $ldapUser->edupersonaffiliation[array_key_last($ldapUser->edupersonaffiliation)],
                    'title' => $ldapUser->title[0],
                ]);
                $this->info('User created.');
            } else {
                $this->error('User not found.');
                return;
            }
        }

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
