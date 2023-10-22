<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('login', 'App\Http\Controllers\AuthController@show')->name('login')->middleware('guest');
Route::post('login', 'App\Http\Controllers\AuthController@authenticate');
Route::get('logout', 'App\Http\Controllers\AuthController@logout')->name('logout')->middleware('auth:admin,employee');

Route::middleware(['auth:admin'])->group(function () {
    Route::get('employees', 'App\Http\Controllers\EmployeeController@index')->name('employees.index');
    Route::post('employees', 'App\Http\Controllers\EmployeeController@store');
    Route::get('employees/create', 'App\Http\Controllers\EmployeeController@create')->name('employees.create');
    Route::get('employees/datatable', 'App\Http\Controllers\EmployeeController@datatable');
    Route::post('employees/{id}', 'App\Http\Controllers\EmployeeController@update');
    Route::get('employees/{id}/edit', 'App\Http\Controllers\EmployeeController@edit')->name('employees.edit');
    Route::post('employees/{id}/destroy', 'App\Http\Controllers\EmployeeController@destroy');

    Route::get('items', 'App\Http\Controllers\ItemController@index')->name('items.index');
    Route::post('items', 'App\Http\Controllers\ItemController@store');
    Route::get('items/create', 'App\Http\Controllers\ItemController@create')->name('items.create');
    Route::get('items/datatable', 'App\Http\Controllers\ItemController@datatable');
    Route::post('items/{id}', 'App\Http\Controllers\ItemController@update');
    Route::get('items/{id}/edit', 'App\Http\Controllers\ItemController@edit')->name('items.edit');
    Route::post('items/{id}/destroy', 'App\Http\Controllers\ItemController@destroy');

    Route::get('transactions', 'App\Http\Controllers\TransactionController@index')->name('transactions.index');
    Route::post('transactions', 'App\Http\Controllers\TransactionController@store');
    Route::get('transactions/create', 'App\Http\Controllers\TransactionController@create')->name('transactions.create');
    Route::get('transactions/datatable', 'App\Http\Controllers\TransactionController@datatable');
});

Route::middleware(['auth:admin,employee'])->group(function () {
    Route::get('profile', 'App\Http\Controllers\ProfileController@index')->name('profile');
});
