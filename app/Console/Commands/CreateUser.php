<?php

namespace App\Console\Commands;

use App\User;
use Validator;
use Illuminate\Console\Command;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create
        {name : The name of the user}
        {email : Email used to login}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new user for the application.';

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
    public function handle()
    {
        $name = $this->argument('name');
        $email = $this->argument('email');
        $password = $this->secret('User password:');

        $data = compact('name', 'email', 'password');
        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
        ]);
        if($validator->fails()) {
            foreach($validator->errors()->all() as $error) {
                $this->error($error);
                return 0;
            }
        }

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $this->info('User has been created.');
        $this->comment('You can now login using the email and password entered here.');
    }
}
