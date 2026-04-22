<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicArticleController;
use App\Http\Controllers\Admin\ArticleController;

// Splash
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Routes publiques
Route::get('/articles', [PublicArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{article}', [PublicArticleController::class, 'show'])->name('articles.show');

// Auth (login/logout)
require __DIR__.'/../routes/auth.php';

// Routes Admin protégées
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [ArticleController::class, 'index'])->name('dashboard');

    // CRUD articles
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');

});