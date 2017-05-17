<?php

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
Route::post('/invoice/search', 'InvoiceController@search');
Route::get('/invoice/delete/{id}', 'InvoiceController@delete');
Route::post('/invoice/send', 'InvoiceController@upload');
Route::get('/invoice/show/{id}/{name}', 'InvoiceController@show');
Route::get('/invoice/edit/{id}', 'InvoiceController@edit');
Route::post('/invoice/edit', 'InvoiceController@update');
Route::match(array('GET', 'POST'), '/invoice/report', 'InvoiceController@report');
Route::get('/invoice/download', 'InvoiceController@download');

// Unit routes
Route::get('/unit', 'UnitController@index');
Route::get('/unit/register', 'UnitController@create');
Route::post('/unit/register', 'UnitController@save');
Route::get('/unit/delete/{id}', 'UnitController@delete');
Route::get('/unit/edit/{id}', 'UnitController@edit');
Route::post('/unit/edit', 'UnitController@update');
Route::post('/unit/search', 'UnitController@search');

// Bank routes
Route::get('/bank', 'BankController@index');
Route::get('/bank/register', 'BankController@create');
Route::post('/bank/register', 'BankController@save');
Route::get('/bank/delete/{id}', 'BankController@delete');
Route::get('/bank/edit/{id}', 'BankController@edit');
Route::post('/bank/edit', 'BankController@update');

// Despesa routes
Route::get('/despesa', 'DespesaController@index');
Route::get('/despesa/register', 'DespesaController@create');
Route::post('/despesa/register', 'DespesaController@save');
Route::get('/despesa/delete/{id}', 'DespesaController@delete');
Route::get('/despesa/edit/{id}', 'DespesaController@edit');
Route::post('/despesa/edit', 'DespesaController@update');

// User routes
Route::get('/user', 'UserController@index');
Route::get('/user/register', 'UserController@create');
Route::post('/user/register', 'UserController@save');
Route::get('/user/delete/{id}', 'UserController@delete');
Route::get('/user/edit/{id}', 'UserController@edit');
Route::post('/user/edit', 'UserController@update');
Route::get('/user/redefinirsenha/{id}/{login}', 'UserController@redefinirsenha');

// Password routes
Route::get('/password/{id}', 'PassController@index');
Route::post('/password/edit', 'PassController@update');

// Posto routes
Route::get('/posto', 'PostoController@index');
Route::get('/posto/register', 'PostoController@create');
Route::post('/posto/register', 'PostoController@save');
Route::get('/posto/delete/{id}', 'PostoController@delete');
Route::get('/posto/edit/{id}', 'PostoController@edit');
Route::post('/posto/edit', 'PostoController@update');
Route::post('/posto/search', 'PostoController@search');


Route::get('laravel-version', function() {
    $laravel = app();
    return "Your Laravel version is ".$laravel::VERSION;
});