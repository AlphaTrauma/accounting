<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'name' => 'Новости',
                'description' => 'Последние новости и обновления.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Советы',
                'description' => 'Полезные советы и рекомендации.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Аналитика',
                'description' => 'Аналитические статьи и исследования.',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
