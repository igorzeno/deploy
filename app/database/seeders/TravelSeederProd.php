<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TravelSeederProd extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();

        // Очищаем таблицу если она не пустая
        DB::table('travels')->truncate();

        // Примеры путешествий для продакшена
        $travels = [
            // Публичные путешествия
            [
                'is_public' => true,
                'name' => 'Romantic Paris Getaway',
                'type' => 'romantic',
                'number_of_days' => 5,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'is_public' => true,
                'name' => 'Japanese Cultural Journey',
                'type' => 'cultural',
                'number_of_days' => 14,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'is_public' => true,
                'name' => 'Thai Adventure Expedition',
                'type' => 'adventure',
                'number_of_days' => 10,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'is_public' => true,
                'name' => 'Italian Food & Wine Tour',
                'type' => 'food',
                'number_of_days' => 7,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'is_public' => true,
                'name' => 'Norwegian Northern Lights',
                'type' => 'nature',
                'number_of_days' => 8,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // Приватные путешествия (is_public = false)
            [
                'is_public' => false,
                'name' => 'Corporate Business Trip',
                'type' => 'business',
                'number_of_days' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'is_public' => false,
                'name' => 'Exclusive VIP Safari',
                'type' => 'luxury',
                'number_of_days' => 12,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'is_public' => false,
                'name' => 'Research Expedition',
                'type' => 'academic',
                'number_of_days' => 21,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('travels')->insert($travels);

        $this->command->info('✅ Travels table seeded successfully!');
        $this->command->info('📊 Created: ' . count($travels) . ' travel records');
        $this->command->info('   • Public: ' . collect($travels)->where('is_public', true)->count());
        $this->command->info('   • Private: ' . collect($travels)->where('is_public', false)->count());
    }
}
