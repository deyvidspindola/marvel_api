<?php

namespace Database\Factories;

use App\Models\Creator;
use App\Models\Series;
use Illuminate\Database\Eloquent\Factories\Factory;

class SeriesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Series::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->jobTitle,
            'description' => $this->faker->realText(255),
            'startYear' => $this->faker->year,
            'endYear' => $this->faker->year,
            'rating' => $this->faker->randomLetter,
            'type' => '',
            'thumbnail' => json_encode([
                'path' => $this->faker->imageUrl(),
                'extension' => 'jpg'
            ]),
            'urls' => json_encode(array(
                [
                    'type' => 'details',
                    'url' => $this->faker->url
                ],[
                    'type' => 'details',
                    'url' => $this->faker->url
                ]
            ))
        ];
    }
}
