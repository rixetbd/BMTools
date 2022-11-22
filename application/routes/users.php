<?php

use App\Http\Controllers\Users\UsersController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function(){

    Route::controller(UsersController::class)->prefix('users')->group(function(){
        Route::get('/{username}', 'index')->name('backend.user.index');

    });

});
