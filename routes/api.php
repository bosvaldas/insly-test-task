<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::post('/users', [\App\Http\Controllers\Api\UsersController::class, 'create']);
