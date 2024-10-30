<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuItemsController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ExecutorController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\UsersController;
use App\Models\ExecutorProfile;
use Arcanedev\LogViewer\Http\Controllers\LogViewerController;


Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/data/slides', [SliderController::class, 'main']);
Route::get('/dashboard/menu-items/{type}', [MenuItemsController::class, 'data']);
Route::get('/orders/all', [OrdersController::class, 'main'])->name('orders.main');
Route::get('/guides', [GuideController::class, 'index'])->name('guides');
Route::get('/purchase/complete', [GuideController::class, 'success'])->name('purchase.success');
Route::get('/purchase/{guide}', [GuideController::class, 'purchase'])->name('purchase');


# Маршруты админа / дэшборд
Route::middleware('admin')->prefix('dashboard')->group(function () { 
    Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    # Список пользователей
    Route::get('/users', [UsersController::class, 'index'])->name('users');
    Route::post('/users/role/add', [UsersController::class, 'addRole'])->name('users.addRole');

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
    
    # Редактирование платных гайдов
    Route::get('/guides', [GuideController::class, 'list'])->name('guides.list');
    Route::get('/guides/create', [GuideController::class, 'create'])->name('guides.create');
    Route::put('/guides/store', [GuideController::class, 'store'])->name('guides.store');
    Route::get('/guides/{guide}/edit', [GuideController::class, 'edit'])->name('guides.edit');
    Route::put('/guides/{guide}/update', [GuideController::class, 'update'])->name('guides.update');
    Route::delete('/guides/{guide}', [GuideController::class, 'destroy'])->name('guides.delete');

    Route::get('/logs', [LogViewerController::class, 'index'])->name('log-viewer::logs.index');
    
});

Route::post('/files/upload', [FilesController::class, 'upload']);
Route::post('/files/remove', [FilesController::class, 'remove']);
Route::post('/files/{id}/update', [FilesController::class, 'update']);
Route::get('/file/{id}', [FilesController::class, 'download'])->name('file.download');

Route::get('/article/{identifier}', [ArticleController::class, 'show'])->name('article.show');


Route::middleware('auth')->group(function () {

    // Личный кабинет пользователя
    Route::get('/personal', [HomeController::class, 'personal'])->name('lk');
    Route::get('/personal/tasks', [ExecutorController::class, 'tasks'])->name('lk.tasks');
    Route::get('/personal/orders', [CustomerController::class, 'orders'])->name('lk.orders');
    Route::get('/personal/purchases', [GuideController::class, 'purchases'])->name('lk.purchases');
    Route::get('/files/download/{file_id}', [GuideController::class, 'download'])->name('download');
    Route::get('/order_files/download/{file_id}', [FilesController::class, 'download'])->name('orders.download');
    
    Route::get('/personal/user', [RegisteredUserController::class, 'edit'])->name('lk.user');
    Route::post('/personal/user', [RegisteredUserController::class, 'update'])->name('lk.user.update');
    

    Route::get('/orders/{order}/show', [OrdersController::class, 'show'])->name('orders.show');

    # Маршруты заказчика
    Route::middleware('customer')->group(function(){
        # личный кабинет
        Route::get('/personal/customer', [CustomerController::class, 'edit'])->name('lk.customer');
        Route::post('/personal/customer', [CustomerController::class, 'update'])->name('lk.customer.update');

        # заказ
        Route::resource('orders', OrdersController::class)->except(['show']);
        Route::get('orders/{order}/destroy', [OrdersController::class, 'destroy'])->name('orders.remove');
        Route::get('orders/{order}/publish', [OrdersController::class, 'publish'])->name('orders.publish');
        Route::get('orders/{order}/result', [CustomerController::class, 'result'])->name('orders.result');

        #api
        Route::get('/order/{order}/responses', [OrdersController::class, 'orderResponses']);
        # принять отклик на заказ
        Route::get('/responses/{response}/confirm', [OrdersController::class, 'confirm']);
    });

    # Маршруты исполнителя
    Route::middleware('executor')->group(function(){
        # личный кабинет
        Route::get('/personal/executor', [ExecutorController::class, 'edit'])->name('lk.executor');
        Route::post('/personal/executor', [ExecutorController::class, 'update'])->name('lk.executor.update');

        # взятые заказы
        # отклики
        Route::get('/personal/responses', [ExecutorController::class, 'responses'])->name('lk.responses');
        Route::post('/response/send', [ExecutorController::class, 'sendResponse'])->name('response.send');
        Route::delete('/response/{response}/remove', [ExecutorController::class, 'remove'])->name('response.remove');

        Route::get('/orders/{order}/fulfillment', [ExecutorController::class, 'fulfillment'])->name('orders.fulfillment');
    });

    Route::post('/files', [FilesController::class, 'list'])->name('files');
});

require __DIR__.'/auth.php';
Route::get('/register', [ExecutorController::class, 'create'])->name('register.executor');
Route::post('/executor_register', [ExecutorController::class, 'store'])->name('executor_store');
Route::get('/customer_register', [CustomerController::class, 'create'])->name('register.customer');
Route::post('/customer_register', [CustomerController::class, 'store'])->name('customer_store');

Route::get('/{slug}', [PageController::class, 'show'])->where('slug', '([a-z-_])+')->name('page');
