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

    Route::controller(CategoryController::class)->prefix('categories')->group(function(){
        Route::get('/index', 'index')->name('backend.categories.index');
        Route::post('/store', 'store')->name('backend.categories.store');
        Route::post('/sub-store', 'sub_store')->name('backend.subcategories.store');
        Route::post('/update', 'update')->name('backend.categories.update');
        Route::post('/sub-update', 'sub_update')->name('backend.subcategories.update');
        Route::post('/destroy', 'destroy')->name('backend.categories.destroy');
        Route::post('/sub-destroy', 'sub_destroy')->name('backend.subcategories.destroy');
        Route::get('/sub-categories', 'sub_categories')->name('backend.sub.categories');
        Route::post('/autocategories', 'autocategories')->name('autocategories');
        Route::post('/autosubcategories', 'autosubcategories')->name('autosubcategories');
    });

    Route::get('/test', function(){
        return response()->view('backend.products.category', ['name' => 'rocky']);
    });

});
