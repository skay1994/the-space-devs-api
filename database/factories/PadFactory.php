<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PadFactory extends Factory
{
    public function definition(): array
    {
        return [
            'location_id' => $this->faker->randomNumber(),
            'url' => $this->faker->url(),
            'agency_id' => $this->faker->randomNumber(),
            'name' => $this->faker->name(),
            'info_url' => $this->faker->url(),
            'wiki_url' => $this->faker->url(),
            'map_url' => $this->faker->url(),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'map_image' => $this->faker->word(),
            'total_launch_count' => $this->faker->randomNumber(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
