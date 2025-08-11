<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;

Route::get('/', fn() => redirect()->route('cars.index'));

Route::resource('cars', CarController::class);

Route::middleware('guest')->group(function(){
    Route::get('register', [AuthController::class,'showRegisterForm'])->name('register');
    Route::post('register', [AuthController::class,'register']);
    Route::get('login', [AuthController::class,'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class,'login']);
});

Route::post('logout', [AuthController::class,'logout'])->middleware('auth')->name('logout');
