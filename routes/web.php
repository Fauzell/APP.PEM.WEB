<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('calculator');
});

use App\Http\Controllers\CalculatorController;

Route::get('/calculator', [CalculatorController::class, 'index']);
Route::post('/calculator', [CalculatorController::class, 'calculate'])->name('calculate');
