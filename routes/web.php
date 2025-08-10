<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarsController;

Route::get('/', function () {
    return redirect()->route('cars.index');
});

Route::resource('cars', CarsController::class);

