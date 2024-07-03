<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('services')->insert([
            [
                'name' => 'Бухгалтерский учет',
                'description' => 'Ведение бухгалтерского учета для малого бизнеса.',
                'price' => 5000.00,
                'commission' => 500.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Налоговая отчетность',
                'description' => 'Подготовка и сдача налоговой отчетности.',
                'price' => 3000.00,
                'commission' => 300.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Консультация',
                'description' => 'Консультация по налогам и бухгалтерскому учету.',
                'price' => 1000.00,
                'commission' => 100.00,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
