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
        Route::get('/create', 'create')->name('backend.products.create');
        Route::post('/store', 'store')->name('backend.products.store');
    });

    

});
