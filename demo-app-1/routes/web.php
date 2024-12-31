<?php

use Illuminate\Support\Facades\Route;
use Spatie\Health\Http\Controllers\HealthCheckResultsController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    Route::apiResource('posts', \App\Http\Controllers\PostController::class);

    Route::get('health', HealthCheckResultsController::class);
    Route::get('health-json', \Spatie\Health\Http\Controllers\HealthCheckJsonResultsController::class);

});
