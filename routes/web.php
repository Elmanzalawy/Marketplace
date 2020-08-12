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
Route::get('cart/buyAll','CartController@buyAll');
Route::get('seller/{id}','ProductsController@seller');
Route::get('/', 'PagesController@index');
Route::get('/index', 'PagesController@index');

// Product Routes
Route::resource('products','ProductsController');
Route::put('/products/{product}/buy', 'ProductsController@buy');
Route::resource('cart','CartController');
Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
