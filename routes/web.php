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
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route for Fuzzy Time Series (publicly accessible)
Route::get('/fuzzy-time-series', [FuzzyTimeSeriesController::class, 'index'])->name('fuzzy-time-series.index');
Route::post('/fuzzy-time-series', [FuzzyTimeSeriesController::class, 'store'])->name('fuzzy-time-series.store');
Route::get('/fuzzy-time-series/result', [FuzzyTimeSeriesController::class, 'result'])->name('fuzzy-time-series.result');

// Protected routes (require authentication)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    
    // Wilayah CRUD
    Route::resource('wilayah', WilayahController::class);
    
    // Stunting CRUD
    Route::resource('stunting', StuntingController::class);
});
