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

Route::middleware('auth')->group(function(){

    Route::controller(ProductController::class)->prefix('products')->group(function(){
        Route::get('/index', 'index')->name('backend.products.index');
        Route::get('/create', 'create')->name('backend.products.create');
        Route::post('/store', 'store')->name('backend.products.store');
        Route::post('/destroy', 'destroy')->name('backend.products.destroy');
        Route::post('/autoproducts', 'autoproducts')->name('autoproducts');
    });
    
});



Route::get('/abcd', [ProductController::class, 'autoproducts']);
