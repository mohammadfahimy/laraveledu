<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'amount' => rand(1000,9999),
            'ref_code' => '123dsa23242ds',
            'status' => $this->faker->randomElement('paiyd','unpayid'),
            'user_id' => User::first() ?? User::factory(),
        ];
    }
}
