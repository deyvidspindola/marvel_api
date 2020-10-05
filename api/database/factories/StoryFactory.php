<?php

namespace Database\Factories;

use App\Models\Creator;
use App\Models\Story;
use Illuminate\Database\Eloquent\Factories\Factory;

class StoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Story::class;

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
            'thumbnail' => json_encode([
                'path' => $this->faker->imageUrl(),
                'extension' => 'jpg'
            ]),
            'type' => $this->faker->word
        ];
    }
}
