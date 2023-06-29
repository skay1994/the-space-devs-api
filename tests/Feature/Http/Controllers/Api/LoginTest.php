<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

it('Api access unauthorized by missing token', function () {
    $this->getJson(route('api.profile'))
        ->assertUnauthorized();
});

it('Api access login successfully', function () {
    $email = fake()->safeEmail();
    $password = 'password';

    $user = User::factory()->create([
        'email' => $email,
        'password' => Hash::make($password),
    ]);

    $response = $this->postJson(route('api.login'), [
        'email' => $email,
        'password' => $password,
    ])->assertOk();

    $response->assertJsonPath('user.name', $user->name)
        ->assertJsonPath('user.email', $email);

    $this->withHeaders([
        'Authorization' => 'Bearer ' . $response->json('token'),
    ])->getJson(route('api.profile'))
        ->assertOk();
});

it('Api logout successfully', function () {
    $email = fake()->safeEmail();
    $password = 'password';

    $user = User::factory()->create([
        'email' => $email,
        'password' => Hash::make($password),
    ]);
    $token = $user->createToken('API Token')->plainTextToken;

    $this->withHeaders([
        'Authorization' => 'Bearer ' . $token,
    ]);

    $this->postJson(route('api.logout'))
        ->assertOk()
        ->assertJsonPath('message', 'Logged out successfully.');

    $this->assertDatabaseCount('personal_access_tokens', 0);
});

it('Api login try with invalid form', function () {
    $response = $this->postJson('/api/login', [
        'email' => null,
        'password' => null,
    ]);

    $response->assertJsonValidationErrorFor('email')
        ->assertJsonValidationErrorFor('password')
        ->assertUnprocessable();
});

it('Api login try without email field', function () {
    $response = $this->postJson('/api/login', [
        'email' => null,
        'password' => 'password',
    ]);

    $response->assertJsonValidationErrorFor('email')
        ->assertUnprocessable();
});

it('Api login try without password field', function () {
    $response = $this->postJson('/api/login', [
        'email' => fake()->safeEmail(),
        'password' => null,
    ]);

    $response->assertJsonValidationErrorFor('password')
        ->assertUnprocessable();
});

it('Api login try without valid email', function () {
    $response = $this->postJson('/api/login', [
        'email' => fake()->word(),
        'password' => 'password',
    ]);

    $response->assertJsonValidationErrorFor('email')
        ->assertUnprocessable();
});
