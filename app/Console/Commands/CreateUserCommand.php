<?php

namespace App\Console\Commands;

use App\Models\Role;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class CreateUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user['name'] = $this->ask('What is the name?');
        $user['email'] = $this->ask('What is the email?');
        $user['password'] = Hash::make($this->secret('Enter password'));

        $roleName = $this->choice('Role of the new user ', ['admin', 'editor'], default:1);
        $role = Role::where('name', $roleName)->first();
        if(!$role)
        {
            $this->error('Role not found');
            return -1;
        }

        DB::transaction(function() use ($user, $role){
        $newUser = User::create($user);
        $newUser->roles()->attach($role->id);
        });
        

        $this->info('User '.$user['email'].' created succefully');
        return 0;
    }
}
