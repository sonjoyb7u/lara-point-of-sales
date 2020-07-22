<?php

use Illuminate\Support\Facades\Route;

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
Route::get('admin/dashboard', function () {
    return view('admin.home');
});

Auth::routes();

Route::group(['prefix' => '/home', 'middleware' => ['auth', 'status']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // USER SECTION ROUTE...
    Route::group(['prefix' => 'user', 'namespace' => 'Admin\User', 'as' => 'user.'], function () {
        Route::get('/', 'UserController@index')->name('index');
        Route::get('create', 'UserController@create')->name('create');
        Route::post('store', 'UserController@store')->name('store');
        Route::get('show/{id}', 'UserController@show')->name('show');
        Route::get('edit/{id}', 'UserController@edit')->name('edit');
        Route::put('update/{id}', 'UserController@update')->name('update');
        Route::get('delete/{id}', 'UserController@destroy')->name('delete');
        Route::post('status', 'UserController@status')->name('status');
    });
    // USER PROFILE SECTION ROUTE...
    Route::group(['prefix' => 'user/profile', 'namespace' => 'Admin\User\Profile', 'as' => 'user.profile.'], function () {
        Route::get('/', 'UserProfileController@index')->name('index');
        Route::get('edit', 'UserProfileController@edit')->name('edit');
        Route::put('update', 'UserProfileController@update')->name('update');
        Route::get('password/edit', 'UserProfileController@passwordEdit')->name('password.edit');
        Route::post('password/update', 'UserProfileController@passwordUpdate')->name('password.update');
    });
    // SUPPLIER SECTION ROUTE...
    Route::group(['prefix' => 'suppliers', 'namespace' => 'Admin\Supplier', 'as' => 'supplier.'], function () {
        Route::get('/', 'SupplierController@index')->name('index');
        Route::get('create', 'SupplierController@create')->name('create');
        Route::post('store', 'SupplierController@store')->name('store');
        Route::get('show/{id}', 'SupplierController@show')->name('show');
        Route::get('edit/{id}', 'SupplierController@edit')->name('edit');
        Route::put('update/{id}', 'SupplierController@update')->name('update');
        Route::get('delete/{id}', 'SupplierController@destroy')->name('delete');
        Route::post('status', 'SupplierController@status')->name('status');
    });
    // CUSTOMER SECTION ROUTE...
    Route::group(['prefix' => 'customers', 'namespace' => 'Admin\Customer', 'as' => 'customer.'], function () {
        Route::get('/', 'CustomerController@index')->name('index');
        Route::get('create', 'CustomerController@create')->name('create');
        Route::post('store', 'CustomerController@store')->name('store');
        Route::get('show/{id}', 'CustomerController@show')->name('show');
        Route::get('edit/{id}', 'CustomerController@edit')->name('edit');
        Route::put('update/{id}', 'CustomerController@update')->name('update');
        Route::get('delete/{id}', 'CustomerController@destroy')->name('delete');
        Route::post('status', 'CustomerController@status')->name('status');
    });
    // UNIT SECTION ROUTE...
    Route::group(['prefix' => 'units', 'namespace' => 'Admin\Unit', 'as' => 'unit.'], function () {
        Route::get('/', 'UnitController@index')->name('index');
        Route::get('create', 'UnitController@create')->name('create');
        Route::post('store', 'UnitController@store')->name('store');
        Route::get('show/{id}', 'UnitController@show')->name('show');
        Route::get('edit/{id}', 'UnitController@edit')->name('edit');
        Route::put('update/{id}', 'UnitController@update')->name('update');
        Route::get('delete/{id}', 'UnitController@destroy')->name('delete');
        Route::post('status', 'UnitController@status')->name('status');
    });
    // CATEGORY SECTION ROUTE...
    Route::group(['prefix' => 'categories', 'namespace' => 'Admin\Category', 'as' => 'category.'], function () {
        Route::get('/', 'CategoryController@index')->name('index');
        Route::get('create', 'CategoryController@create')->name('create');
        Route::post('store', 'CategoryController@store')->name('store');
        Route::get('show/{id}', 'CategoryController@show')->name('show');
        Route::get('edit/{id}', 'CategoryController@edit')->name('edit');
        Route::put('update/{id}', 'CategoryController@update')->name('update');
        Route::get('delete/{id}', 'CategoryController@destroy')->name('delete');
        Route::post('status', 'CategoryController@status')->name('status');
    });



    
});
