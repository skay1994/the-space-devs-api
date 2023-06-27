<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class LaunchServiceProviderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'url' => $this->faker->url(),
            'name' => $this->faker->name(),
            'type' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
