<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            [
                'first_name' => 'Styop',
                'last_name' => 'Hambardzumyan',
                'email' => 'stepanham777@gmail.com',
                'email_verified_at' => now(),
                'password' => '123456789'
            ]
        )->assignRole('admin');
    }
}
