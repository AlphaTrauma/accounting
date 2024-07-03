<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->insert([
            [
                'key' => 'site_name',
                'value' => 'My Freelance Platform',
                'description' => 'Название сайта',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'key' => 'site_email',
                'value' => 'info@accounting.test',
                'description' => 'Контактный email сайта',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'key' => 'site_phone',
                'value' => '+7975576564',
                'description' => 'Контактный телефон сайта',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'key' => 'site_address',
                'value' => '123 Freelance St, City, Country',
                'description' => 'Физический адрес',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'key' => 'header_script',
                'value' => '',
                'description' => 'Код в header сайта, используйте для интеграций с сервисами, предоставляющими сниппеты для вставки в html.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'key' => 'footer_script',
                'value' => '',
                'description' => 'Код перед закрывающим тегом </body> сайта, используйте для интеграций с сервисами, предоставляющими сниппеты для вставки в html.',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
