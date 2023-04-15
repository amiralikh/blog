<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $users = User::query()->select('id')->get();

        if ($users->isEmpty()) {
            $this->command->info('No users found. Skipping post seeding.');
            return;
        }
        $postCount = 100; // Number of posts to create per user

        for ($i = 0; $i < $postCount; $i++) {
            $user_id = $users->random()->id;
            Post::query()->create([
                'user_id' => $user_id,
                'title' => fake()->realText(40),
                'content' => fake()->text(450),
            ]);
        }
    }
}
