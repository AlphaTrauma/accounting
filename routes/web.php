<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuItemsController;
use App\Http\Controllers\ArticleController;



Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index']);

Route::prefix('dashboard')->group(function () {
    Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index']);

    # Редактирование навигации
    Route::get('/menu-manager', [MenuItemsController::class, 'index'])->name('menu');
    Route::get('/menu-items', [MenuItemsController::class, 'data']);
    Route::post('/menu-items', [MenuItemsController::class, 'store']);
    Route::put('/menu-items/{id}', [MenuItemsController::class, 'update']);
    Route::delete('/menu-items/{id}', [MenuItemsController::class, 'destroy']);

    # Редактирование статей
    Route::get('/articles', [ArticleController::class, 'index'])->name('articles');
    Route::get('/article/{id?}', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::get('/article/{id}/data', [ArticleController::class, 'data']);
    Route::post('/article/{id}', [ArticleController::class, 'store']);
    Route::delete('/article/{id}', [ArticleController::class, 'destroy']);


});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
