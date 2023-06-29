<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\LaunchController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('login', LoginController::class)->name('api.login');

Route::middleware('auth:sanctum')->as('api.')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::name('profile')->get('/user', static function (Request $request) {
        return $request->user();
    });

    Route::resource('launchers', LaunchController::class);
});
