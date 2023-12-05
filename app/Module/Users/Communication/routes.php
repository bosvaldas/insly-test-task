<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::get('/users', \App\Module\Users\Communication\Controller\UsersListController::class);
Route::post('/users', \App\Module\Users\Communication\Controller\UsersCreateController::class);
Route::put('/users/{id}', \App\Module\Users\Communication\Controller\UsersUpdateController::class);
Route::delete('/users/{id}', \App\Module\Users\Communication\Controller\UsersDeleteController::class);
