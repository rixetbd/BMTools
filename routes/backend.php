<?php

use App\Http\Controllers\Products\CategoryController;
use App\Http\Controllers\Products\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');

Route::get('/user', [App\Http\Controllers\HomeController::class, 'user_index'])->name('backend.user.index');

Route::middleware('auth')->group(function(){

    Route::controller(ProductController::class)->prefix('products')->group(function(){

        Route::get('/create', 'create')->name('backend.products.create');
        Route::post('/store', 'store')->name('backend.products.store');

    });

    Route::controller(CategoryController::class)->prefix('categories')->group(function(){
        Route::get('/index', 'index')->name('backend.categories.index');
        Route::post('/store', 'store')->name('backend.categories.store');
        Route::post('/destroy', 'destroy')->name('backend.categories.destroy');
        Route::post('/autocategories', 'autocategories')->name('autocategories');
    });


});
