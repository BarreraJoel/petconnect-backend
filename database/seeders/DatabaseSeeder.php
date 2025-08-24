<?php

namespace Database\Seeders;

use App\Models\Api\v1\Post;
use App\Models\Api\v1\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(3)->create();
        Post::factory(10)->create();
    }
}
