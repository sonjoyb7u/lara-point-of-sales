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

    // SUB CATEGORY SECTION ROUTE...
    Route::group(['prefix' => 'sub-categories', 'namespace' => 'Admin\SubCategory', 'as' => 'sub-category.'], function () {
        Route::get('/', 'SubCategoryController@index')->name('index');
        Route::get('create', 'SubCategoryController@create')->name('create');
        Route::post('store', 'SubCategoryController@store')->name('store');
        Route::get('show/{id}', 'SubCategoryController@show')->name('show');
        Route::get('edit/{id}', 'SubCategoryController@edit')->name('edit');
        Route::put('update/{id}', 'SubCategoryController@update')->name('update');
        Route::get('delete/{id}', 'SubCategoryController@destroy')->name('delete');
        Route::post('status', 'SubCategoryController@status')->name('status');
    });

    // PRODUCT SECTION ROUTE...
    Route::group(['prefix' => 'products', 'namespace' => 'Admin\Product', 'as' => 'product.'], function () {
        Route::get('/', 'ProductController@index')->name('index');
        Route::get('create', 'ProductController@create')->name('create');
        Route::post('store', 'ProductController@store')->name('store');
        Route::get('show/{id}', 'ProductController@show')->name('show');
        Route::get('edit/{id}', 'ProductController@edit')->name('edit');
        Route::put('update/{id}', 'ProductController@update')->name('update');
        Route::get('delete/{id}', 'ProductController@destroy')->name('delete');
        Route::post('status', 'ProductController@status')->name('status');
    });

    // PURCHASE SECTION ROUTE...
    Route::group(['prefix' => 'purchases', 'namespace' => 'Admin\Purchase', 'as' => 'purchase.'], function () {
        Route::get('/', 'PurchaseController@index')->name('index');
        Route::get('create', 'PurchaseController@create')->name('create');
        Route::post('store', 'PurchaseController@store')->name('store');
        Route::get('show/{id}', 'PurchaseController@show')->name('show');
        Route::get('edit/{id}', 'PurchaseController@edit')->name('edit');
        Route::put('update/{id}', 'PurchaseController@update')->name('update');
        Route::get('delete/{id}', 'PurchaseController@destroy')->name('delete');
        Route::post('status', 'PurchaseController@status')->name('status');
        Route::post('supp-wise-cat', 'PurchaseController@supplierWiseCategory')->name('supp-wise-cat');
        Route::post('cat-wise-subcat', 'PurchaseController@categoryWiseSubCategory')->name('cat-wise-subcat');
        Route::post('cat-wise-unit', 'PurchaseController@categoryWiseUnit')->name('cat-wise-unit');
        Route::post('cat-wise-product', 'PurchaseController@categoryWiseProduct')->name('cat-wise-product');
        Route::get('check-product-stock/{product_id}', 'PurchaseController@checkProductStock')->name('check-product-stock');
        Route::post('check-product-stock', 'PurchaseController@checkProductListStock')->name('check-product-stock');
        Route::get('manage-status', 'PurchaseController@manageStatus')->name('manage-status');
        Route::get('approved-status/{id}', 'PurchaseController@approvedStatus')->name('approved-status');
        Route::get('pending-status/{id}', 'PurchaseController@pendingStatus')->name('pending-status');
        Route::get('return-status/{id}', 'PurchaseController@returnStatus')->name('return-status');
    });

    // PURCHASE SECTION ROUTE...
    Route::group(['prefix' => 'invoices', 'namespace' => 'Admin\Invoice', 'as' => 'invoice.'], function () {
        Route::get('/', 'InvoiceController@index')->name('index');
        Route::get('create', 'InvoiceController@create')->name('create');
        Route::post('store', 'InvoiceController@store')->name('store');
        Route::get('show/{id}', 'InvoiceController@show')->name('show');
        Route::get('edit/{id}', 'InvoiceController@edit')->name('edit');
        Route::put('update/{id}', 'InvoiceController@update')->name('update');
        Route::get('delete/{id}', 'InvoiceController@destroy')->name('delete');
        Route::post('status', 'InvoiceController@status')->name('status');
        Route::post('supp-wise-cat', 'InvoiceController@supplierWiseCategory')->name('supp-wise-cat');
        Route::post('cat-wise-subcat', 'InvoiceController@categoryWiseSubCategory')->name('cat-wise-subcat');
        Route::post('cat-wise-unit', 'InvoiceController@categoryWiseUnit')->name('cat-wise-unit');
        Route::post('cat-wise-product', 'InvoiceController@categoryWiseProduct')->name('cat-wise-product');
        Route::get('check-product-stock/{product_id}', 'InvoiceController@checkProductStock')->name('check-product-stock');
        Route::post('check-product-stock', 'InvoiceController@checkProductListStock')->name('check-product-stock');
        Route::get('manage-status', 'InvoiceController@manageStatus')->name('manage-status');
        Route::get('approved-status/{id}', 'InvoiceController@approvedStatus')->name('approved-status');
        Route::get('pending-status/{id}', 'InvoiceController@pendingStatus')->name('pending-status');
        Route::get('return-status/{id}', 'InvoiceController@returnStatus')->name('return-status');
    });



    
});
