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

// Login routes
Route::get('/', 'LoginController@index');
Route::post('/login', 'LoginController@auth');
Route::get('/logout', 'LoginController@logout');

// Home routes
Route::get('/home', 'HomeController@index');

// Supplier routes
Route::get('/supplier', 'SupplierController@index');
Route::get('/supplier/register', 'SupplierController@create');
Route::post('/supplier/register', 'SupplierController@save');
Route::get('/supplier/delete/{id}', 'SupplierController@delete');
Route::get('/supplier/edit/{id}', 'SupplierController@edit');
Route::post('/supplier/edit', 'SupplierController@update');
Route::post('/supplier/search', 'SupplierController@search');

// Invoice routes
Route::get('/invoice', 'InvoiceController@index');
Route::get('/invoice/register', 'InvoiceController@create');
Route::post('/invoice/register', 'InvoiceController@save');
Route::get('/invoice/delete/{id}', 'InvoiceController@delete');
Route::post('/invoice/send', 'InvoiceController@upload');

// Unit routes
Route::get('/unit', 'UnitController@index');
Route::get('/unit/register', 'UnitController@create');
Route::post('/unit/register', 'UnitController@save');
Route::get('/unit/delete/{id}', 'UnitController@delete');

// Bank routes
Route::get('/bank', 'BankController@index');
Route::get('/bank/register', 'BankController@create');
Route::post('/bank/register', 'BankController@save');
Route::get('/bank/delete/{id}', 'BankController@delete');
