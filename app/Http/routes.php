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

// Invoice route
Route::get('/invoice', 'InvoiceController@index');
Route::get('/invoice/register', 'InvoiceController@create');

// Unit route
Route::get('/unit', 'UnitController@index');
Route::get('/unit/register', 'UnitController@create');

// Bank route
Route::get('/bank', 'BankController@index');
Route::get('/bank/register', 'BankController@create');