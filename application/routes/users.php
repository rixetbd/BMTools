<?php

use App\Http\Controllers\Users\EmployeeController;
use App\Http\Controllers\Users\UsersController;
use App\Models\Employee;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function(){

    Route::controller(UsersController::class)->prefix('users')->group(function(){
        Route::post('/autoauth', 'autoauth')->name('backend.user.autoauth');

        Route::get('/{username}', 'index')->name('backend.user.index');
        Route::post('/update', 'update')->name('backend.user.update');
    });


    Route::controller(EmployeeController::class)->prefix('employee')->group(function(){
        Route::get('/', 'index')->name('backend.employee.index');
        Route::post('/store', 'store')->name('backend.employee.store');
        Route::post('/destroy', 'destroy')->name('backend.employee.destroy');
        Route::get('/autoemployees', 'autoemployees')->name('autoemployees');

    });


});
