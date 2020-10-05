<?php

namespace Database\Seeders;

use App\Models\Character;
use App\Models\Comic;
use App\Models\Creator;
use App\Models\Event;
use App\Models\Series;
use App\Models\Story;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Character::factory(10)
            ->has(Event::factory()->count(5))
            ->has(Series::factory()->count(5))
            ->has(Story::factory()->count(5))
            ->has(Comic::factory()->count(5))
            ->create();


    }
}
