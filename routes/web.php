<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicArticleController;

// Splash
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Routes publiques
Route::get('/articles', [PublicArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{article}', [PublicArticleController::class, 'show'])->name('articles.show');

// Auth
require __DIR__.'/../routes/auth.php';

// Dashboard
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});