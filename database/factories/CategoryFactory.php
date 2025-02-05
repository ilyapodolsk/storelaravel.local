<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = ['Комедии', 'Исторические', 'Мелодрамы', 'Триллеры', 'Боевики'];
        return [
            'title' => $this->faker->unique()->randomElement($title),
            'movie_id' => mt_rand(1, 16)
        ];
    }
}
