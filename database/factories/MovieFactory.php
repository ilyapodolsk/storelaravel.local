<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $aliases = ['butterfly', 'fei-ying', 'fifth-element', 'ivan-vasilievich', 'leon', 'lock-stock', 'manhattan-melodrama', 'rush-hour', 'rush-hour-2', 'scary-movie', 'scary-movie-2', 'schindler-list', 'snatch', 'this-war', 'spartak', 'who-am-i'];
        return [
            'title' => $this->faker->realText(mt_rand(10, 15)),
            'date' => $this->faker->year($max = 'now'),
            'category_id' => mt_rand(1, 5),
            'country' => $this->faker->country(),
            'producer' => $this->faker->name(),
            'duration' => $this->duration(),
            'actors' => $this->actors(),
            'price' => mt_rand(100, 500),
            'description' => $this->faker->realText(mt_rand(320, 420)),
            'product_id' => mt_rand(1, 40),
            'alias' => $this->faker->unique()->randomElement($aliases),
        ];
    }

    public function actors()
    {
        $numActors = mt_rand(1, 5);
        $actors = [];
        for ($i = 0; $i < $numActors; $i++) {
            $actors[] = $this->faker->name();
        }
        return implode(', ', $actors);
    }

    public function duration() 
    {
        $maxSeconds = 2 * 3600 + 55 * 60;
        $randomSeconds = $this->faker->numberBetween(0, $maxSeconds);
      
        $hours = floor($randomSeconds / 3600);
        $minutes = floor(($randomSeconds % 3600) / 60);
        $seconds = $randomSeconds % 60;
      
        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }
    

}
