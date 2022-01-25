<?php

namespace App\Console\Commands;

use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

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
        $availableRoles = Role::all(['id', 'name', 'code']);

        $role = Role::STORE_OWNER;

        while ($role === Role::STORE_OWNER) {
            /**
             * Just keep on asking for role until user selects role other than store_owner as that will require to
             * create an actual shop.
             */
            $role = $this->choice(
                'Please select desired role.',
                $availableRoles->pluck('code')->toArray(),
                $availableRoles->search(function ($role) {
                    return $role->code === Role::STORE_OWNER;
                }),
                null,
                false
            );
            if ($role === Role::STORE_OWNER) {
                $this->info("I am very sorry, creating store_owner users from this command is not done yet.");
            }
        }

        $shouldAskInfo = true;
        while ($shouldAskInfo) {
            $information = $this->askInformation();
            $shouldAskInfo = $this->validateInformation($information);
        }

        unset($information['password_confirmation']);

        $user = new User($information);
        $user->save();

        RoleUser::updateOrCreate([
            'user_id' => $user->id
        ], [
            'role_id' => $availableRoles->firstWhere('code', $role)->id,
        ]);

        $this->info("Congrats! You are now able to access the app. Have fun!");

        return 0;
    }

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
