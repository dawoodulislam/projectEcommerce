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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [
    'uses' => 'App\Http\Controllers\EcommerceController@index',
    'as'   => '/'
]);

Route::get('/category-product/{kak}', [
    'uses' => 'App\Http\Controllers\EcommerceController@categoryProduct',
    'as'   => 'category-product'
]);

Route::get('/productDetail/{id}', [
    'uses' => 'App\Http\Controllers\EcommerceController@productDetail',
    'as'   => 'productDetail'
]);

// cart controller route start
Route::post('/add-to-cart', [
    'uses' => 'App\Http\Controllers\CartController@index',
    'as'   => 'add-to-cart'
]);

Route::get('/direct-add-to-cart/{id}', [
    'uses' => 'App\Http\Controllers\CartController@directAddToCart',
    'as'   => 'direct-add-to-cart'
]);

Route::get('/show-cart', [
    'uses' => 'App\Http\Controllers\CartController@show',
    'as' => 'show-cart'
]);

Route::get('/remove-item/{rowId}', [
    'uses' => 'App\Http\Controllers\CartController@remove',
    'as' => 'remove-item'
]);

Route::post('/update-cart-qty', [
    'uses' => 'App\Http\Controllers\CartController@update',
    'as' => 'update-cart-qty'
]);
// cart controller route end

// Check Out controller route start

Route::get('/checkout', [
    'uses' => 'App\Http\Controllers\CheckoutController@index',
    'as' => 'checkout'
]);

Route::get('/get-email-availability', [
    'uses' => 'App\Http\Controllers\CheckoutController@checkEmail',
    'as' => 'get-email-availability'
]);

Route::post('/new-customer', [
    'uses' => 'App\Http\Controllers\CheckoutController@addCustomer',
    'as' => 'new-customer'
]);

Route::get('/billing-address', [
    'uses' => 'App\Http\Controllers\CheckoutController@billingInfo',
    'as' => 'billing-address'
]);

Route::post('/customer-logout', [
    'uses' => 'App\Http\Controllers\CheckoutController@logOut',
    'as' => 'customer-logout'
]);

Route::post('/new-payment', [
    'uses' => 'App\Http\Controllers\CheckoutController@paymentOption',
    'as' => 'new-payment'
]);

Route::post('/customer-login', [
    'uses' => 'App\Http\Controllers\CheckoutController@customerLogin',
    'as' => 'customer-login'
]);

Route::get('/show-payment', [
    'uses' => 'App\Http\Controllers\CheckoutController@payment',
    'as'   => 'show-payment'
]);

Route::post('/new-order', [
    'uses' => 'App\Http\Controllers\CheckoutController@newOrder',
    'as'   => 'new-order'
]);

Route::get('/complete-order', [
    'uses' => 'App\Http\Controllers\CheckoutController@completeOrder',
    'as'   => 'complete-order'
]);

Route::get('/online-payment', [
    'uses' => 'App\Http\Controllers\CheckoutController@onlinePayment',
    'as'   => 'online-payment'
]);

Route::post('/confirm-online-payment', [
    'uses' => 'App\Http\Controllers\CheckoutController@confirmOrder',
    'as'   => 'confirm-online-payment'
]);

// Check Out controller route end

//Dashboard or admin panel Route


// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');



Route::get('/dashboard', [
    'uses' => 'App\Http\Controllers\DashboardController@index',
    'as'   => 'dashboard',
    'middleware' => ['auth:sanctum', 'verified']
]);

//category controller start

Route::get('/add-category', [
    'uses' => 'App\Http\Controllers\CategoryController@add',
    'as'   => 'add-category',
    'middleware' => ['auth:sanctum', 'verified']
]);

Route::get('/manage-category', [
    'uses' => 'App\Http\Controllers\CategoryController@manage',
    'as'   => 'manage-category',
    'middleware' => ['auth:sanctum', 'verified']
]);

Route::post('/new-category', [
    'uses' => 'App\Http\Controllers\CategoryController@new',
    'as'   => 'new-category',
    'middleware' => ['auth:sanctum', 'verified']
]);

Route::get('/edit-category/{id}', [
    'uses' => 'App\Http\Controllers\CategoryController@edit',
    'as'   => 'edit-category',
    'middleware' => ['auth:sanctum', 'verified']
]);

Route::post('/update-category', [
    'uses' => 'App\Http\Controllers\CategoryController@update',
    'as'   => 'update-category',
    'middleware' => ['auth:sanctum', 'verified']
]);

Route::get('/delete-category/{id}', [
    'uses' => 'App\Http\Controllers\CategoryController@delete',
    'as'   => 'delete-category',
    'middleware' => ['auth:sanctum', 'verified']
]);
//category controller end


//Brand controller start

Route::get('/add-brand', [
    'uses' => 'App\Http\Controllers\BrandController@add',
    'as'   => 'add-brand',
    'middleware' => ['auth:sanctum', 'verified']
]);

Route::get('/manage-brand', [
    'uses' => 'App\Http\Controllers\BrandController@manage',
    'as'   => 'manage-brand',
    'middleware' => ['auth:sanctum', 'verified']
]);

Route::post('/new-brand', [
    'uses' => 'App\Http\Controllers\BrandController@new',
    'as'   => 'new-brand',
    'middleware' => ['auth:sanctum', 'verified']
]);

Route::get('/edit-brand/{id}', [
    'uses' => 'App\Http\Controllers\BrandController@edit',
    'as'   => 'edit-brand',
    'middleware' => ['auth:sanctum', 'verified']
]);

Route::post('/update-brand', [
    'uses' => 'App\Http\Controllers\BrandController@update',
    'as'   => 'update-brand',
    'middleware' => ['auth:sanctum', 'verified']
]);

Route::get('/delete-brand/{id}', [
    'uses' => 'App\Http\Controllers\BrandController@delete',
    'as'   => 'delete-brand',
    'middleware' => ['auth:sanctum', 'verified']
]);
//brand controller end

//Product controller start

Route::get('/add-product', [
    'uses' => 'App\Http\Controllers\ProductController@add',
    'as'   => 'add-product',
    'middleware' => ['auth:sanctum', 'verified']
]);

Route::get('/manage-product', [
    'uses' => 'App\Http\Controllers\ProductController@manage',
    'as'   => 'manage-product',
    'middleware' => ['auth:sanctum', 'verified']
]);

Route::post('/new-product', [
    'uses' => 'App\Http\Controllers\ProductController@create',
    'as'   => 'new-product',
    'middleware' => ['auth:sanctum', 'verified']
]);


Route::get('/product-detail/{id}', [
    'uses' => 'App\Http\Controllers\ProductController@detail',
    'as'   => 'product-detail',
    'middleware' => ['auth:sanctum', 'verified']
]);

Route::get('/edit-product/{id}', [
    'uses' => 'App\Http\Controllers\ProductController@edit',
    'as'  => 'edit-product',
    'middleware' => ['auth:sanctum', 'verified']
]);

Route::post('/update-product', [
    'uses' => 'App\Http\Controllers\ProductController@update',
    'as'  => 'update-product',
    'middleware' => ['auth:sanctum', 'verified']
]);

Route::get('/delete-product/{id}', [
    'uses' => 'App\Http\Controllers\ProductController@delete',
    'as'  => 'delete-product',
    'middleware' => ['auth:sanctum', 'verified']
]);
//Product controller end


//order controller start

Route::get('/manage-order', [
    'uses' => 'App\Http\Controllers\OrderController@index',
    'as'   => 'manage-order',
    'middleware' => ['auth:sanctum', 'verified']
]);

Route::get('/view-detail/{id}', [
    'uses' => 'App\Http\Controllers\OrderController@viewDetail',
    'as'   => 'view-detail',
    'middleware' => ['auth:sanctum', 'verified']
]);

Route::get('/view-invoice/{id}', [
    'uses' => 'App\Http\Controllers\OrderController@viewInvoice',
    'as'   => 'view-invoice',
    'middleware' => ['auth:sanctum', 'verified']
]);

Route::get('/download-invoice/{id}', [
    'uses' => 'App\Http\Controllers\OrderController@downloadInvoice',
    'as'   => 'download-invoice',
    'middleware' => ['auth:sanctum', 'verified']
]);

Route::get('/edit-order/{id}', [
    'uses' => 'App\Http\Controllers\OrderController@editOrder',
    'as'   => 'edit-order',
    'middleware' => ['auth:sanctum', 'verified']
]);

Route::post('/update-order', [
    'uses' => 'App\Http\Controllers\OrderController@updateOrder',
    'as'   => 'update-order',
    'middleware' => ['auth:sanctum', 'verified']
]);

Route::get('/delete-order/{id}', [
    'uses' => 'App\Http\Controllers\OrderController@deleteOrder',
    'as' => 'delete-order',
    'middleware' => ['auth:sanctum', 'verified']
]);
//order controller end

//user controller start

Route::get('/add-user', [
    'uses' => 'App\Http\Controllers\UserController@index',
    'as' => 'add-user',
    'middleware' => ['auth:sanctum', 'verified', 'roleControl']

]);
Route::post('/create-user', [
    'uses' => 'App\Http\Controllers\UserController@create',
    'as' => 'create-user',
    'middleware' => ['auth:sanctum', 'verified', 'roleControl']
]);
//user controller end
