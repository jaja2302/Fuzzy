<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FuzzyTimeSeriesController;

Route::get('/', function () {
    return view('welcome');
});

// Route untuk Fuzzy Time Series (bisa diakses tanpa login)
Route::get('/fuzzy-time-series', [FuzzyTimeSeriesController::class, 'index'])->name('fuzzy-time-series.index');
Route::post('/fuzzy-time-series/calculate', [FuzzyTimeSeriesController::class, 'calculate'])->name('fuzzy-time-series.calculate');
Route::get('/fuzzy-time-series/data', [FuzzyTimeSeriesController::class, 'getData'])->name('fuzzy-time-series.data');
