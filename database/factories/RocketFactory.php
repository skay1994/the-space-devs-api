<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class RocketFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'family' => $this->faker->word(),
            'variant' => $this->faker->word(),
            'configuration' => $this->faker->words(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
