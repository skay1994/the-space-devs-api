<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class OrbitFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'abbrev' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
