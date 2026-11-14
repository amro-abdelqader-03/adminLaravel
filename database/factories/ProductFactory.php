<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Seller;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'name' => fake()->sentence(3),
            'description' => fake()->sentence(3),
            'seller_id' => Seller::inRandomOrder()->first()->id,
            'price' => fake()->numberBetween(50,500),
            'cost' => fake()->numberBetween(50,500),
            'image' => fake()->imageUrl(640, 480, 'products', true),
        ];
    }
}
