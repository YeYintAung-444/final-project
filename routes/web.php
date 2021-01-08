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
    return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.register');
});

// Route::get('/', function () {
//     return view('welcome');
// });
Auth::routes();
// Auth::routes(['register'=>false]);

Route::get('/home', 'HomeController@index')->name('home');


// Sales Page
Route::middleware('role:sales_staff')->group(function(){

Route::get('/sales','MainController@sales')->name('salespage');
Route::get('product','MainController@product')->name('productpage');
Route::get('orderdetails','MainController@orderdetails')->name('orderdetailspage');
Route::get('ordersuccess','MainController@ordersuccess')->name('ordersuccesspage');
Route::resource('customers','CustomerController');
Route::get('/getCustomer','CustomerController@getCustomer')->name('getCustomerpage');
Route::resource('ways','WayController');
Route::get('way','WayController@session')->name('session');
Route::resource('price_stocks','PriceStockController');
Route::get('quantity/reative','ProductController@qty_reactive')->name('qty_reactive');


});

// Admin Page
Route::middleware('role:admin')->group(function(){
Route::get('/admin','MainController@admin')->name('adminpage');
Route::resource('categories','CategoryController');
Route::resource('brands','BrandController');
Route::resource('subcategories','SubcategoryController');
Route::get('/changestatus','OrderController@changestatus')->name('changestatuspage');
Route::get('userlist','MainController@userlist')->name('userpage');
Route::get('stockadd','ProductController@stockadd')->name('stockadd');

});

// Delivery Page
Route::get('/delivery','MainController@confirmlist')->name('confirmpage');

Route::resource('orders','OrderController');
Route::resource('ways','WayController');
Route::get('way','WayController@session')->name('session');
Route::resource('products','ProductController');
Route::get('/delistatus','OrderController@delistatus')->name('delistatus');

// Order
Route::get('/info','OrderController@info')->name('orderinfo');
Route::get('/status','OrderController@status')->name('status');
Route::get('/nav','OrderController@nav')->name('nav');
Route::get('/search','OrderController@search')->name('search');
Route::get('/earning','OrderController@earning')->name('earning');
Route::get('/orderdetail','OrderController@detail')->name('orderdetail');
Route::get('orderlist','MainController@orderlist')->name('orderlistpage');
Route::get('/user','OrderController@user')->name('user');


//Registration
Route::get('registration', 'AuthController@registration')->name('registerpage');

Route::get('/documentation','MainController@documentation')->name('documentation');
