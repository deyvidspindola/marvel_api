<?php

namespace Database\Factories;

use App\Models\Creator;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

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
            'start' => $this->faker->dateTime,
            'end' => $this->faker->dateTime,
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
