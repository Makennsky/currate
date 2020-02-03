<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed
     */
    public function handle(): void
    {
        $name       =   $this->ask('your name');
        $mail       =   $this->ask('your email');
        $password   =   $this->ask('your password');
        if (User::query()->where('email', '=', $mail)->count()) {
            $this->warn('User already exist!');
            if ($this->confirm('try again?')) {
                $this->handle();
            }
        } else {
            User::query()->forceCreate(
                [
                    'name'      =>  $name,
                    'email'     =>  $mail,
                    'password'  =>  Hash::make($password),
                    'api_token' =>  Str::random(40)
                ]
            );
            $this->info('User successfully created!');
        }
    }
}
