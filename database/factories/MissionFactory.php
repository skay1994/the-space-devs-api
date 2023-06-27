<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class MissionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'orbit_id' => $this->faker->randomNumber(),
            'launch_library_id' => $this->faker->randomNumber(),
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'launch_designator' => $this->faker->word(),
            'type' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
