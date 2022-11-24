<?php

use App\Http\Controllers\Users\CustomerController;
use App\Http\Controllers\Users\EmployeeController;
use App\Http\Controllers\Users\SalaryController;
use App\Http\Controllers\Users\SupplierController;
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
        Route::post('/edit', 'edit')->name('backend.employee.edit');
        Route::post('/destroy', 'destroy')->name('backend.employee.destroy');
        Route::get('/autoemployees', 'autoemployees')->name('autoemployees');

    });


    Route::controller(CustomerController::class)->prefix('customers')->group(function(){
        Route::get('/', 'index')->name('backend.customers.index');
        Route::post('/store', 'store')->name('backend.customers.store');
        Route::post('/edit', 'edit')->name('backend.customers.edit');
        Route::post('/destroy', 'destroy')->name('backend.customers.destroy');
        Route::get('/autocustomers', 'autocustomers')->name('autocustomers');

    });


    Route::controller(SupplierController::class)->prefix('suppliers')->group(function(){
        Route::get('/', 'index')->name('backend.suppliers.index');
        Route::post('/store', 'store')->name('backend.suppliers.store');
        Route::post('/edit', 'edit')->name('backend.suppliers.edit');
        Route::post('/destroy', 'destroy')->name('backend.suppliers.destroy');
        Route::get('/autosuppliers', 'autosuppliers')->name('autosuppliers');

    });

    Route::controller(SalaryController::class)->prefix('salary')->group(function(){
        Route::get('/', 'index')->name('backend.salary.index');
        Route::post('/store', 'store')->name('backend.salary.store');
        Route::post('/edit', 'edit')->name('backend.salary.edit');
        Route::post('/destroy', 'destroy')->name('backend.salary.destroy');
        Route::get('/autosalaries', 'autosalaries')->name('autosalaries');

    });


});
