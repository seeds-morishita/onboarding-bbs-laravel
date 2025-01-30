<?php

namespace Database\Seeders;

use App\Models\Article;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(ArticlesTableSeeder::class);

        Article::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
