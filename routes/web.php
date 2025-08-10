<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FuzzyTimeSeriesController;
use App\Http\Controllers\WilayahController;
use App\Http\Controllers\StuntingController;

Route::get('/', function () {
    return view('welcome');
});

// Route for Fuzzy Time Series (publicly accessible)
Route::get('/fuzzy-time-series', [FuzzyTimeSeriesController::class, 'index'])->name('fuzzy-time-series.index');
Route::post('/fuzzy-time-series/calculate', [FuzzyTimeSeriesController::class, 'calculate'])->name('fuzzy-time-series.calculate');
Route::get('/fuzzy-time-series/data', [FuzzyTimeSeriesController::class, 'getData'])->name('fuzzy-time-series.data');

// Resource routes for Wilayah and Stunting CRUD
Route::resource('wilayah', WilayahController::class);
Route::resource('stunting', StuntingController::class);
