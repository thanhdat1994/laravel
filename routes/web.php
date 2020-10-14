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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('ajaxRequest', 'OrderController@ajaxGetCustomerByPhone')->name('ajaxRequest.post');

Route::prefix('admin')->group(function () {
	Route::resource('/customer', 'CustomerController');
	Route::resource('/product', 'ProductController');
	Route::resource('/category', 'CategoryController');
	Route::resource('/inventory', 'ProductInventoryController');
	Route::resource('/order', 'OrderController');
	Route::resource('/customer-class', 'CustomerClassController');
	Route::resource('/expense', 'ExpenseController');
    Route::post('/category/import', 'CategoryController@import')->name('category.import');
    Route::get('/export', 'CustomerController@export')->name('export');
    Route::post('customer/search', 'CustomerController@search')->name('customer.search');
});

Route::get('/statistical', 'StatisticalController@index')->name('statistical');
Route::post('/statistical/revenue', 'StatisticalController@revenue')->name('statistical.revenue');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
