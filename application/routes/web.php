<?php

use App\Http\Controllers\Settings\SettingController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware('auth')->group(function(){

    Route::controller(SettingController::class)->prefix('settings')->group(function(){
        Route::get('/index', 'index')->name('backend.settings.index');
        // Route::get('/store', 'store')->name('backend.settings.store');
        // Route::post('/update', 'update')->name('backend.settings.update');
        // Route::post('/destroy', 'destroy')->name('backend.settings.destroy');
    });
});
