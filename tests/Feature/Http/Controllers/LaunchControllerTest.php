<?php

use App\Models\Launch;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

it('Get all launchers without token', function () {
    $this->getJson(route('api.launchers.index'))
        ->assertUnauthorized();
});

it('Get all launchers', function () {
    Sanctum::actingAs(User::factory()->create());
    Launch::factory()->count(20)->create();

    $response = $this->getJson(route('api.launchers.index'))
        ->assertOk();

    $response->assertJsonPath('meta.per_page', 10)
        ->assertJsonPath('meta.total', 20)
        ->assertJsonCount(10, 'data')
        ->assertJsonStructure(['data' => [['uuid','name', 'provider_name', 'rocket_name']]]);
});

it('Get all launchers with pagination limit per_page ', function () {
    Sanctum::actingAs(User::factory()->create());
    Launch::factory()->count(20)->create();
    $limit = 5;

    $response = $this->getJson(route('api.launchers.index', ['per_page' => $limit]))
        ->assertOk();

    $response->assertJsonPath('meta.per_page', $limit)
        ->assertJsonCount($limit, 'data')
        ->assertJsonPath('meta.total', 20)
        ->assertJsonCount($limit, 'data')
        ->assertJsonStructure(['data' => [['uuid','name', 'provider_name', 'rocket_name']]]);
});
