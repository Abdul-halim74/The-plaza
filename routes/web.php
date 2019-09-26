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



Route::resource('users','UserController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/add/product/view', 'ProductController@addproductview');

Route::post('/add/product/insert', 'ProductController@addproductinsert');
Route::get('/delete/product/{product_id}', 'ProductController@deleteproduct');
Route::get('/restore/product/{product_id}', 'ProductController@restoreproduct');
Route::get('/permanently_delete/product/{product_id}', 'ProductController@permanently_deleteproduct');
Route::get('/edit/product/{product_id}', 'ProductController@editproduct');
Route::post('edit/product/insert', 'ProductController@editproductinsert');



Route::get('uploadFileRoute','UserController@uploadFile');

Route::post('uploadFilePost', 'UserController@uploadFileMethod');



//frontend Routes

Route::get('/','FrontendController@index');
Route::get('/product/details/{product_id}','FrontendController@productdetails');
Route::get('/contact', 'FrontendController@contact');

Route::post('/contact/insert', 'FrontendController@contactinsert');

///contact/message/view
Route::get('/contact/message/view', 'HomeController@contactmessageview');
Route::get('/read/message/{msg_id}', 'HomeController@readmessage');

//Category controller
Route::get('/add/category/view', 'CategoryController@addCategoryView');
Route::post('/add/category/insert', 'CategoryController@addCategoryInsert');
Route::get('/category/wise/product/{category_id}', 'CategoryController@categorywiseproduct');



//add/to/cart
Route::get('/add/to/cart/{product_id}','CartController@addtocart');
Route::get('/cart','CartController@cart');
Route::get('/delete/from/cart/{cart_id}','CartController@deletefromcart');
Route::get('/clear/cart','CartController@clearcart');
