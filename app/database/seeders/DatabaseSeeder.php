<?php

namespace Database\Seeders;

use App\Models\Travel;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $env = env('APP_ENV', 'production');

        if ($env === 'production') {
            $this->call([
                TravelSeederProd::class,
            ]);
        } else {
            Travel::factory()
                ->count(2)
                ->hasTours(5)
                ->create();
            Travel::factory()
                ->count(3)
                ->hasTours(6)
                ->create();
            Travel::factory()
                ->count(4)
                ->hasTours(2)
                ->create();
        }
    }
}
