<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\MeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Status\StatusController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::post('register', [RegisterController::class, 'register'])->name('register');
    Route::post('login', [LoginController::class, 'login'])->name('login');
});
Route::middleware('auth:sanctum')->group(function () {
    Route::get('me', MeController::class);
    Route::get('status', [StatusController::class, 'index'])->name("status");
    Route::post('status/create', [StatusController::class, 'store'])->name("status");
});
