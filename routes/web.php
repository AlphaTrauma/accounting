<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuItemsController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SliderController;
use Arcanedev\LogViewer\Http\Controllers\LogViewerController;


Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/data/slides', [SliderController::class, 'main']);
Route::get('/dashboard/menu-items/{type}', [MenuItemsController::class, 'data']);

Route::prefix('dashboard')->group(function () {
    Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    # Редактирование слайдера  
    Route::get('/slider', [SliderController::class, 'slider'])->name('slider');
    Route::get('/slider/data', [SliderController::class, 'sliderData']);
    Route::post('/slider/delete/{id}', [SliderController::class, 'removeSlide']);
    Route::post('/slider/update/{id?}', [SliderController::class, 'updateSlide']);
    Route::post('/button/update', [SliderController::class, 'updateButton']);
    Route::post('/button/remove', [SliderController::class, 'removeButton']);
    Route::post('/slider/ordering', [SliderController::class, 'updateOrdering']);

    # Редактирование навигации
    Route::get('/menu-manager', [MenuItemsController::class, 'index'])->name('menu'); 
    Route::post('/menu-items', [MenuItemsController::class, 'store']);
    Route::put('/menu-items/{id}', [MenuItemsController::class, 'update']);
    Route::delete('/menu-items/{id}', [MenuItemsController::class, 'destroy']);

    # Редактирование партнёрки
    Route::get('/affiliate-menu', [MenuItemsController::class, 'affiliate'])->name('affiliate');

    # Редактирование категорий статей
    Route::get('/categories', [CategoriesController::class, 'index'])->name('categories');
    Route::get('/categories/data', [CategoriesController::class, 'data']);
    Route::post('/categories/create', [CategoriesController::class, 'create']);
    Route::post('/category/remove', [CategoriesController::class, 'remove']);
    Route::post('/category/update', [CategoriesController::class, 'update']);

    # Редактирование статей
    Route::get('/articles', [ArticleController::class, 'index'])->name('article.list'); 
    Route::get('/article/edit/{id?}', [ArticleController::class, 'edit'])->name('article.edit');
    Route::get('/article/{id}/data', [ArticleController::class, 'data']);
    Route::post('/article/store', [ArticleController::class, 'store']);
    Route::post('/article/update', [ArticleController::class, 'update']); 
    Route::get('/article/{id}/remove', [ArticleController::class, 'destroy'])->name('article.remove'); 

    # Редактирование страниц, практически идентично статьям
    Route::get('/pages', [PageController::class, 'index'])->name('page.list'); 
    Route::get('/page/edit/{id?}', [PageController::class, 'edit'])->name('page.edit');
    Route::get('/page/{id}/data', [PageController::class, 'data']);
    Route::post('/page/store', [PageController::class, 'store']);
    Route::post('/page/update', [PageController::class, 'update']); 
    Route::get('/page/{id}/remove', [PageController::class, 'destroy'])->name('page.remove');
    

    Route::get('/logs', [LogViewerController::class, 'index'])->name('log-viewer::logs.index');
    
});

Route::post('/files/upload', [FilesController::class, 'upload']);
Route::get('/article/{identifier}', [ArticleController::class, 'show'])->name('article.show');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/{slug}', [PageController::class, 'show'])->where('slug', '([a-z-_])+')->name('page');
