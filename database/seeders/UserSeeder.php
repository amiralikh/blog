<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userCount = 10;

        for ($i = 0; $i < $userCount; $i++) {
            User::query()->create([
                'name' => fake()->firstName.' '.fake()->lastName,
                'email' => fake()->unique()->safeEmail,
                'email_verified_at' => now(),
                'password' => Hash::make('password'), // Set a default password for all users
            ]);
        }
    }
}
