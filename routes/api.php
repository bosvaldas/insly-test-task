<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::post('/users', \App\Http\Controllers\Api\UsersCreateController::class);
Route::put('/users/{id}', \App\Http\Controllers\Api\UsersUpdateController::class);
