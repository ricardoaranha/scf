<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


// Home route
Route::get('/', 'HomeController@index');

// Login route
Route::get('/login', 'LoginController@index');
Route::post('/login', 'LoginController@auth');
Route::get('/logout', 'LoginController@logout');

// Supplier route
Route::get('/supplier', 'SupplierController@index');
Route::get('/supplier/register', 'SupplierController@create');
Route::post('/supplier/register', 'SupplierController@save');
Route::get('/supplier/delete/{id}', 'SupplierController@delete');

// Invoice route
Route::get('/invoice', 'InvoiceController@index');
Route::get('/invoice/register', 'InvoiceController@create');
Route::post('/invoice/register', 'InvoiceController@save');
Route::get('/invoice/delete/{id}', 'InvoiceController@delete');

// Unit route
Route::get('/unit', 'UnitController@index');
Route::get('/unit/register', 'UnitController@create');
Route::post('/unit/register', 'UnitController@save');
Route::get('/unit/delete/{id}', 'UnitController@delete');

// Bank route
Route::get('/bank', 'BankController@index');
Route::get('/bank/register', 'BankController@create');
Route::post('/bank/register', 'BankController@save');
Route::get('/bank/delete/{id}', 'BankController@delete');
