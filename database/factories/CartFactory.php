<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cart>
 */
class CartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->email(),
            'delivery' => mt_rand(0, 1),
            'address' => $this->faker->address(),
            'comment' => $this->faker->realText(mt_rand(30, 150)),
            'products' => $this->faker->realText(mt_rand(10, 15)),
            'price' => mt_rand(100, 5000),
        ];
    }
}
