<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/**
 * Get an user along with comment by user id
 * Must provide id as querystring
 */
Route::get('/', [UserController::class, 'show']);

/**
 * Get an user along with comment by user id
 * @param int $id
 */
Route::get('users/{id}', [UserController::class, 'show']);

/**
 * add comments of an user
 */
Route::post('users/{id}/comments', [UserController::class, 'comments']);
