<?php
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\AuthController;

Route::get('/', function() {
    return redirect()->route('cars.index');
});

Route::prefix('cars')->name('cars.')->controller(CarsController::class)->group(function() {
    Route::get('show','show')->name('show');
    Route::get('index','index')->name('index');
    Route::post('store', 'store')->name('store');
    Route::get('create','create')->name('create');
});

Route::prefix('user')->name('user.')->controller(UsuarioController::class)->group(function() {
    Route::get('showperfil','showPerfil')->name('showperfil');
});

Route::get('register', [UsuarioController::class,'showRegisterForm'])->name('register');
Route::post('step1', [UsuarioController::class, 'step1'])->name('step1');
Route::get('step2', [UsuarioController::class, 'showStep2']);
Route::post('step2', [UsuarioController::class, 'step2'])->name('step2');
Route::get('step3', [UsuarioController::class, 'showStep3']);
Route::post('step3', [UsuarioController::class, 'step3'])->name('step3');

Route::get('login', [AuthController::class,'showLoginForm'])->name('showlogin');
Route::post('login', [AuthController::class,'login'])->name('login');

Route::post('logout', [AuthController::class,'logout'])->name('logout');
