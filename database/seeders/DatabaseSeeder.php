<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Tag;
use App\Models\Discussion;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            TagSeeder::class,
            DiscussionSeeder::class,
        ]);
    }
}
