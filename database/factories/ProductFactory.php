<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition()
    {
        return [
            'title'  => $this->faker->name(),
            'price'  => rand(1000,9999),
            'slug'   => $this->faker->slug(),
            'description' => $this->faker->realText(),
        ];
    }
}
