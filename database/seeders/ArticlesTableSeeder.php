<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Article::create([
            'id' => 1,
            'name' => 'examle1',
            'content' => 'aaa',
        ]);

        Article::create([
            'id' => 2,
            'name' => 'examle2',
            'content' => 'bbb',
        ]);
    }
}
