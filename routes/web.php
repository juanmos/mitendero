<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'ApplicationController@web');
// Route::get('/{any}', 'ApplicationController')->where('any', '.*');



// Route::group(['middleware' => 'auth'], function () {
   
//EMPLOYEES
Route::get('/employees', 'EmployeeController@index')->name('employee.index');
Route::get('/employees/{employee}', 'EmployeeController@show')->name('employee.show');    
Route::post('/employees', 'EmployeeController@store')->name('employee.store');
Route::patch('/employees/{employee}', 'EmployeeController@update')->name('employee.update');
Route::delete('/employees/{employee}', 'EmployeeController@destroy')->name('employee.destroy');
Route::patch('/employees/{employeeId}/restore', 'EmployeeController@recover')->name('employee.recover');

//CONTRACTS
Route::get('/contracts', 'ContractController@index')->name('contract.index');
Route::get('/contracts/{contract}', 'ContractController@show')->name('contract.show');    
Route::post('/contracts', 'ContractController@store')->name('contract.store');
Route::patch('/contracts/{contract}', 'ContractController@update')->name('contract.update');
Route::delete('/contracts/{contract}', 'ContractController@destroy')->name('contract.destroy');
Route::patch('/contracts/{contractId}/restore', 'ContractController@recover')->name('contract.recover');

//CATEGORIES
// Route::get('/categories', 'CategoryController@index')->name('category.index');
// Route::get('category/{category}', 'CategoryController@show')->name('category.show');
        
// });
