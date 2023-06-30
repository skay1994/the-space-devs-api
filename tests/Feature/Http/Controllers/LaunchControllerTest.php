<?php

use App\Models\Launch;
use App\Models\User;
use Illuminate\Support\Str;
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
        ->assertJsonStructure(['data' => [['uuid', 'name', 'provider_name', 'rocket_name']]]);
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
        ->assertJsonStructure(['data' => [['uuid', 'name', 'provider_name', 'rocket_name']]]);
});

it('Get a launch with invalid uuid', function () {
    Sanctum::actingAs(User::factory()->create());

    $this->getJson(route('api.launchers.show', ['launcher' => Str::uuid()]))
        ->assertNotFound();
});

it('Get a launch', function () {
    Sanctum::actingAs(User::factory()->create());
    $launch = Launch::factory()->create();

    $response = $this->getJson(route('api.launchers.show', ['launcher' => $launch->getKey()]))
        ->assertOk();

    $response->assertJsonPath('data.uuid', $launch->getKey())
        ->assertJsonPath('data.name', $launch->name)
        ->assertJsonPath('data.provider.name', $launch->provider->name)
        ->assertJsonPath('data.rocket.name', $launch->rocket->name)
        ->assertJsonPath('data.status', $launch->status->value)
        ->assertJsonPath('data.status_name', $launch->status->name());
});

it('Create a launch', function () {
    Sanctum::actingAs(User::factory()->create());
    $launch = Launch::factory()->make();
    unset($launch->slug);

    $response = $this->postJson(route('api.launchers.store'), $launch->toArray())
        ->assertCreated();

    $response->assertJsonPath('data.name', $launch->name)
        ->assertJsonPath('data.slug', Str::slug($launch->name))
        ->assertJsonPath('data.status', $launch->status->value)
        ->assertJsonPath('data.status_name', $launch->status->name())
        ->assertJsonPath('data.provider.name', $launch->provider->name)
        ->assertJsonPath('data.rocket.name', $launch->rocket->name);
});

it('Create a launch fail by invalid form', function () {
    Sanctum::actingAs(User::factory()->create());
    $launch = Launch::factory()->make();
    $launch->fill([
        'launch_provider_id' => null,
        'rocket_id' => null,
        'name' => null,
        'url' => null,
        'status' => null,
        'inhold' => null,
    ]);

    $response = $this->postJson(route('api.launchers.store'), $launch->toArray())
        ->assertUnprocessable();

    $response->assertJsonValidationErrorFor('launch_provider_id')
        ->assertJsonValidationErrorFor('rocket_id')
        ->assertJsonValidationErrorFor('name')
        ->assertJsonValidationErrorFor('url')
        ->assertJsonValidationErrorFor('status')
        ->assertJsonValidationErrorFor('inhold');
});

it('Create a launch failed by invalid rocket_id', function () {
    Sanctum::actingAs(User::factory()->create());
    $launch = Launch::factory()->make([
        'rocket_id' => fake()->randomNumber(3),
    ]);

    $this->postJson(route('api.launchers.store'), $launch->toArray())
        ->assertUnprocessable()
        ->assertJsonValidationErrorFor('rocket_id');
});

it('Create a launch failed by invalid launch_provider_id', function () {
    Sanctum::actingAs(User::factory()->create());
    $launch = Launch::factory()->make([
        'launch_provider_id' => fake()->randomNumber(3),
    ]);

    $this->postJson(route('api.launchers.store'), $launch->toArray())
        ->assertUnprocessable()
        ->assertJsonValidationErrorFor('launch_provider_id');
});

it('Update a launch fail by invalid uuid', function () {
    Sanctum::actingAs(User::factory()->create());
    $this->putJson(route('api.launchers.update', ['launcher' => Str::uuid()]), [])
        ->assertNotFound();
});

it('Update a launch', function () {
    Sanctum::actingAs(User::factory()->create());
    $launch = Launch::factory()->create();

    $name = fake()->name();

    $launch->fill(compact('name'));

    $response = $this->putJson(route('api.launchers.update', ['launcher' => $launch->getKey()]),
        $launch->toArray()
    )->assertOk();

    $launch->refresh();

    $response->assertJsonPath('data.name', $name);

    $this->assertEquals($launch->name, $name);
});

it('Update a launch fail by invalid form', function () {
    Sanctum::actingAs(User::factory()->create());
    $launch = Launch::factory()->create();
    $launch->fill([
        'launch_provider_id' => null,
        'rocket_id' => null,
        'name' => null,
        'url' => null,
        'status' => null,
        'inhold' => null,
    ]);

    $response = $this->putJson(route('api.launchers.update', ['launcher' => $launch->getKey()]),
        $launch->toArray()
    )->assertUnprocessable();

    $response->assertJsonValidationErrorFor('launch_provider_id')
        ->assertJsonValidationErrorFor('rocket_id')
        ->assertJsonValidationErrorFor('name')
        ->assertJsonValidationErrorFor('url')
        ->assertJsonValidationErrorFor('status')
        ->assertJsonValidationErrorFor('inhold');
});

it('Update a launch failed by invalid rocket_id', function () {
    Sanctum::actingAs(User::factory()->create());
    $launch = Launch::factory()->create();
    $launch->fill([
        'rocket_id' => fake()->randomNumber(3),
    ]);

    $this->putJson(route('api.launchers.update', ['launcher' => $launch->getKey()]), $launch->toArray())
        ->assertUnprocessable()
        ->assertJsonValidationErrorFor('rocket_id');
});

it('Update a launch failed by invalid launch_provider_id', function () {
    Sanctum::actingAs(User::factory()->create());
    $launch = Launch::factory()->create();
    $launch->fill([
        'launch_provider_id' => fake()->randomNumber(3),
    ]);

    $this->putJson(route('api.launchers.update', ['launcher' => $launch->getKey()]), $launch->toArray())
        ->assertUnprocessable()
        ->assertJsonValidationErrorFor('launch_provider_id');
});
