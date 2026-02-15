<?php

namespace Database\Seeders;

use App\Models\categories;
use App\Models\Products;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        categories::factory()->create([
            'description' => 'Test Category',
        ]
        );

        categories::factory()->create([
                'description' => '2 categoria',
            ]
        );

        Products::factory(5)->create();
    }
}
