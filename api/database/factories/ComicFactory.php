<?php

namespace Database\Factories;

use App\Models\Comic;
use App\Models\Creator;
use Illuminate\Database\Eloquent\Factories\Factory;

class ComicFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comic::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'digitalId' => $this->faker->numberBetween($min = 1000, $max = 90000),
            'title' => $this->faker->jobTitle,
            'issueNumber' => $this->faker->numerify($string = '##'),
            'variantDescription' => $this->faker->text(255),
            'description' => $this->faker->realText(255),
            'isbn' => '',
            'upc' => $this->faker->numerify($string = '##########-#####'),
            'diamondCode' => $this->faker->bothify($string = '??######'),
            'ean' => '',
            'issn' => '',
            'format' => $this->faker->word,
            'pageCount' => $this->faker->numerify($string = '##'),
            'prices' => json_encode(array(
                [
                    'type' => $this->faker->word,
                    'price'=> $this->faker->numerify($string = '##.##')
                ],[
                    'type' => $this->faker->word,
                    'price'=> $this->faker->numerify($string = '##.##')
                ]
            )),
            'thumbnail' => json_encode([
                'path' => $this->faker->imageUrl(),
                'extension' => 'jpg'
            ]),
            'images' => json_encode(array(
                [
                    'path' => $this->faker->imageUrl(),
                    'extension' => 'jpg'
                ],[
                    'path' => $this->faker->imageUrl(),
                    'extension' => 'jpg'
                ],[
                    'path' => $this->faker->imageUrl(),
                    'extension' => 'jpg'
                ]
            )),
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
