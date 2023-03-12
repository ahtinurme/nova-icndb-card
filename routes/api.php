<?php

use Illuminate\Support\Facades\Route;
use Swapnilsarwe\NovaIcndbCard\Http\Controllers\ICNDbJokeController;

/*
|--------------------------------------------------------------------------
| Card API Routes
|--------------------------------------------------------------------------
|
| Here is where you may register API routes for your card. These routes
| are loaded by the ServiceProvider of your card. You're free to add
| as many additional routes to this file as your card may require.
|
*/

Route::get('/random', ICNDbJokeController::class);
