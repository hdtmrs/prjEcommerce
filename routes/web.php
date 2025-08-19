<?php
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\CarsController;

Route::get('/', function() {
    return redirect()->route('cars.index');
});

Route::resource('cars', CarsController::class);

Route::middleware('guest')->group(function(){
    Route::get('register', [UsuarioController::class,'showRegisterForm'])->name('register');
    Route::post('step1', [UsuarioController::class, 'step1'])->name('step1');
    Route::get('step2', [UsuarioController::class, 'showStep2']);
    Route::post('step2', [UsuarioController::class, 'step2'])->name('step2');
    Route::get('step3', [UsuarioController::class, 'showStep3']);
    Route::post('step3', [UsuarioController::class, 'step3'])->name('step3');
    Route::get('login', [UsuarioController::class,'showLoginForm'])->name('login');
    Route::post('login', [UsuarioController::class,'login']);
});

Route::post('logout', [UsuarioController::class,'logout'])->middleware('auth')->name('logout');
