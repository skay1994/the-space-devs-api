<?php

namespace Database\Factories;

use App\Enums\Status;
use App\Models\LaunchServiceProvider;
use App\Models\Rocket;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class LaunchFactory extends Factory
{
    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid(),
            'launch_provider_id' => LaunchServiceProvider::factory(),
            'rocket_id' => Rocket::factory(),
            'url' => $this->faker->url(),
            'launch_library_id' => $this->faker->randomNumber(),
            'name' => $this->faker->name(),
            'slug' => $this->faker->slug(),
            'status' => $this->faker->randomElement(Status::values()),
            'net' => Carbon::now(),
            'window_start' => Carbon::now(),
            'window_end' => Carbon::now(),
            'inhold' => $this->faker->boolean(),
            'tbdtime' => Carbon::now(),
            'tbddate' => Carbon::now(),
            'probability' => $this->faker->word(),
            'holdreason' => $this->faker->word(),
            'failreason' => $this->faker->word(),
            'hashtag' => $this->faker->word(),
            'webcast_live' => $this->faker->boolean(),
            'image' => $this->faker->imageUrl,
            'infographic' => $this->faker->word(),
            'program' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
