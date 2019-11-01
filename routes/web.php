<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->group(function () {

    Route::get('/', 'HomeController@dashboard')->name('dashboard');

    Route::resource('categories', 'CategoryController')->except([
        'show','destroy'
    ]);

    Route::resource('products', 'ProductController')->except([
        'show','destroy'
    ]);

    Route::resource('roles', 'RoleController')->except([
        'show','destroy'
    ]);

    Route::resource('units', 'UnitController')->except([
        'show','destroy'
    ]);

    Route::resource('converts', 'ConvertController')->except([
        'show','destroy'
    ]);

    Route::resource('suppliers', 'SupplierController')->except([
        'show','destroy'
    ]);

    Route::resource('orders', 'OrderController')->except([
        'show','destroy'
    ]);

});

// CUSTOM


Route::get('/getUnits/{id}', 'ApiController@getUnits')->name('getUnit');
Route::get('/getProduct/{id}', 'ApiController@getProduct')->name('getProduct');
Route::get('/handleConvert/{id}', 'ApiController@handleConvert')->name('handleConvert');

Route::get('/categories/{category}','CategoryController@destroy')->name('categories.destroy');
Route::get('/units/{unit}','UnitController@destroy')->name('units.destroy');
Route::get('/products/{product}','ProductController@destroy')->name('products.destroy');
Route::get('/roles/{role}','RoleController@destroy')->name('roles.destroy');
Route::get('/converts/{convert}','ConvertController@destroy')->name('converts.destroy');
Route::get('/suppliers/{supplier}','SupplierController@destroy')->name('suppliers.destroy');
Route::get('/orders/{order}','OrderController@destroy')->name('orders.destroy');
