<?php

namespace Tests\Helpers;

use App\Models\User;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

trait UserHelpers
{
    protected function userFactory(): array {
        $faker = Factory::create();
        return [
            'first_name' => $faker->firstName(),
            'last_name' => $faker->lastName(),
            'email' => $faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => 'password',
            'remember_token' => Str::random(10),
        ];
    }

    public function createUser()
    {
        $attributes = $this->userFactory();
        $user = create(User::class, $attributes);
        return $user;
    }

    public function createUserAndAuthenticate()
    {
        $attributes = $this->userFactory();
        $user = create(User::class, $attributes);
        $this->be($user, 'api');
        $user->createToken('Login')->accessToken;
        return $user;
    }
}
