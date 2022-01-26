<?php

namespace App\Console\Commands;

use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use JetBrains\PhpStorm\ArrayShape;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create app user.';

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
        $role = $this->askRole();

        $information = [];
        $shouldAskInfo = true;
        while ($shouldAskInfo) {
            $information = $this->askInformation();
            $shouldAskInfo = $this->validateInformation($information);
        }
        unset($information['password_confirmation']);

        $user = new User($information);
        $user->save();
        $user->assignRole($role);

        $this->info("Congrats! You are now able to access the app. Have fun!");

        return 0;
    }

    private function askRole(): string
    {
        $roles = Role::all();

        $role = 'store_owner';

        while ($role === 'store_owner') {
            /**
             * Just keep on asking for role until user selects role other than store_owner as that will require to
             * create an actual shop.
             */
            $role = $this->choice(
                'Please select desired role.',
                $roles->pluck('name')->toArray(),
                $roles->search(function ($role) {
                    return $role->name === 'store_owner';
                }),
                null,
                false
            );
            if ($role === 'store_owner') {
                $this->info("I am very sorry, creating store_owner users from this command is not done yet.");
            }
        }

        return $role;
    }

    #[ArrayShape([
        'first_name' => "mixed",
        'last_name' => "mixed",
        'email' => "mixed",
        'password' => "mixed",
        'password_confirmation' => "mixed"
    ])]
    private function askInformation(): array
    {
        $firstName = $this->ask('What is your first name?');
        $lastName = $this->ask('What is your last name?');
        $email = $this->ask('What is your email address?');
        $password = $this->secret('Please enter your password. Make sure its your bank account password (just kidding).');
        $passwordConfirmation = $this->secret('Please re-enter your password.');

        return [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $passwordConfirmation,
        ];
    }

    private function validateInformation(array $information): bool
    {
        $validator = Validator::make($information, User::RULES);

        if ($validator->fails()) {
            $this->error(implode("\n", $validator->errors()->all()));
            return true;
        }
        return false;
    }
}
