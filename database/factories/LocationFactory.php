<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class LocationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'url' => $this->faker->url(),
            'name' => $this->faker->name(),
            'country_code' => $this->faker->word(),
            'map_image' => $this->faker->word(),
            'total_launch_count' => $this->faker->randomNumber(),
            'total_landing_count' => $this->faker->randomNumber(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
