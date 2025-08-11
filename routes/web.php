<?php
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\CarsController;

Route::get('/', fn() => redirect()->route('cars.index'));

Route::resource('cars', CarsController::class);

Route::middleware('guest')->group(function(){
    Route::get('register', [UsuarioController::class,'showRegisterForm'])->name('register');
    Route::post('register', [UsuarioController::class,'register']);
    Route::get('login', [UsuarioController::class,'showLoginForm'])->name('login');
    Route::post('login', [UsuarioController::class,'login']);
});

Route::post('logout', [UsuarioController::class,'logout'])->middleware('auth')->name('logout');
