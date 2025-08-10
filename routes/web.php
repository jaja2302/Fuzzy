<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FuzzyTimeSeriesController;
use App\Http\Controllers\WilayahController;
use App\Http\Controllers\StuntingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublicController;

Route::get('/', function () {
    return view('welcome');
});

// Public routes (no authentication required)
Route::get('/public/results', [PublicController::class, 'results'])->name('public.results');
Route::get('/public/stunting-data', [PublicController::class, 'stuntingData'])->name('public.stunting-data');
Route::get('/public/wilayah-data', [PublicController::class, 'wilayahData'])->name('public.wilayah-data');

// Authentication routes (public)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Protected routes (require authentication)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Admin routes
    Route::middleware(['admin'])->group(function () {
        // Wilayah management
        Route::resource('wilayah', WilayahController::class);
        
        // Stunting data management
        Route::resource('stunting', StuntingController::class)->parameters([
            'stunting' => 'id_stunting'
        ]);
    });
    
    // Fuzzy Time Series routes
    Route::get('/fuzzy-time-series', [FuzzyTimeSeriesController::class, 'index'])->name('fuzzy-time-series.index');
    Route::post('/fuzzy-time-series/calculate', [FuzzyTimeSeriesController::class, 'calculate'])->name('fuzzy-time-series.calculate');
    Route::post('/fuzzy-time-series/calculate-all', [FuzzyTimeSeriesController::class, 'calculateAllWilayah'])->name('fuzzy-time-series.calculate-all');
    Route::get('/fuzzy-time-series/data', [FuzzyTimeSeriesController::class, 'data'])->name('fuzzy-time-series.data');
    Route::get('/fuzzy-time-series/result', [FuzzyTimeSeriesController::class, 'result'])->name('fuzzy-time-series.result');
});
