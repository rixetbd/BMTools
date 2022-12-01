<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Products\CategoryController;
use App\Http\Controllers\Products\SubCategoryController;
use App\Http\Controllers\Settings\SettingController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

Route::middleware('auth')->group(function(){

    Route::controller(CategoryController::class)->prefix('categories')->group(function(){
        Route::get('/index', 'index')->name('backend.categories.index');
        Route::post('/store', 'store')->name('backend.categories.store');
        Route::post('/update', 'update')->name('backend.categories.update');
        Route::post('/destroy', 'destroy')->name('backend.categories.destroy');
        Route::get('/autocategories', 'autocategories')->name('autocategories');
    });

    Route::controller(SubCategoryController::class)->prefix('subcategories')->group(function(){
        Route::get('/index', 'index')->name('backend.subcategories.index');
        Route::post('/store', 'store')->name('backend.subcategories.store');
        Route::post('/update', 'update')->name('backend.subcategories.update');
        Route::post('/destroy', 'destroy')->name('backend.subcategories.destroy');
        Route::get('/autosubcategories', 'autosubcategories')->name('autosubcategories');
        Route::post('/get-subcategory-auto', 'get_subcategory_auto')->name('backend.get_subcategory_auto');
    });


    Route::controller(SettingController::class)->prefix('settings')->group(function(){
        Route::get('/index', 'index')->name('backend.settings.index');
        Route::post('/store', 'store')->name('backend.settings.store');
        Route::post('/update', 'update')->name('backend.settings.update');
        Route::post('/destroy', 'destroy')->name('backend.settings.destroy');
        Route::get('/autoSettings', 'autoSettings')->name('backend.settings.autoSettings');
    });

});
