<?php

namespace Database\Factories;

use App\Models\Album;
use App\Models\Artist;
use Illuminate\Database\Eloquent\Factories\Factory;

class RecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'        => $this->faker->word(),
            'album_id'    => (Album::all()->random())->id,
            'cover_photo' => '/storage/store.png',
            'artist_id'   => (Artist::all()->random())->id,
            'year'        => $this->faker->regexify('[1-9]{4}'),
        ];
    }
}
