<?php

namespace Database\Factories;

use App\Models\categories;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\products>
 */
class ProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => fake()->numberBetween(0, 20),
            'name' => fake()->name(),
            'quantity' => fake()->randomDigit(),
            'price' => fake()->randomFloat(2, 0, 9999),
            'category_id' => categories::inRandomOrder()->first()->id,
            'description' => fake()->text()
        ];
    }
}
