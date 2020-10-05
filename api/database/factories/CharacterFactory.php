<?php

namespace Database\Factories;

use App\Models\Character;
use App\Models\Comic;
use App\Models\Event;
use App\Models\Series;
use App\Models\Story;
use Illuminate\Database\Eloquent\Factories\Factory;

class CharacterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Character::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->realText(255),
            'urls' => json_encode(array(
                [
                    'type' => 'details',
                    'url' => $this->faker->url
                ],[
                    'type' => 'details',
                    'url' => $this->faker->url
                ]
            )),
            'thumbnail' => json_encode([
                'path' => $this->faker->imageUrl(),
                'extension' => 'jpg'
            ])
        ];
    }
}
