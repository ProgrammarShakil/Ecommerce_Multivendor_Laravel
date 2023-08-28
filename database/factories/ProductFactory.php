<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Type\Integer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
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
            'user_id' => random_int(1,5),
            'category_id' => random_int(1,5),
            'title' => fake()->name(),
            'description' => fake()->name(),
            'product_image_path' => fake()->imageUrl(),
            'status' => 1,
        ];
    }
}
