<?php

use Illuminate\Support\Facades\Route;

//CONTROLLERS
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

//USER BLOCK
Route::resource('users', UserController::class)->only(['edit', 'update']);