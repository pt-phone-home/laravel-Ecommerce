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

// INDEX PAGE
Route::get('/', 'IndexPageController@index')->name('index');

// SHOP PAGE
Route::get('/shop', 'ShopController@index')->name('shop.index');
Route::get('/shop/{slug}', 'ShopController@show')->name('shop.show');

// CART PAGE
Route::get('/cart', 'CartController@index')->name('cart.index');
Route::post('/cart', 'CartController@store')->name('cart.store');
Route::patch('/cart/{product}', 'CartController@update')->name('cart.update');
Route::delete('/cart/{product}', 'CartController@destroy')->name('cart.destroy');
Route::post('/cart/switchToSaveForLater/{product}', 'CartController@switchToSaveForLater')->name('cart.switchToSaveForLater');

// SAVE FOR LATER
Route::delete('/saveForLater/{product}', 'SaveForLaterController@destroy')->name('saveForLater.destroy');
Route::post('/saveForLater/switchToCart/{product}', 'SaveForLaterController@switchToCart')->name('saveForLater.switchToCart');

// CHECKOUT
Route::get('/checkout', 'CheckoutController@index')->name('checkout.index')->middleware('auth');
Route::post('/checkout', 'CheckoutController@store')->name('checkout.store');
Route::get('/guestCheckout', 'CheckoutController@index')->name('guestCheckout.index');

// COUPONS
Route::post('/coupon', 'CouponsController@store')->name('coupon.store');
Route::delete('/coupon', 'CouponsController@destroy')->name('coupon.destroy');
//flush session
Route::get('emptysession', function () {
    session()->flush();
});

// THANK YOU
Route::get('/thankyou', 'IndexPageController@thankYou')->name('thankyou.index');

//Search

Route::get('/search', 'ShopController@search')->name('search');


Route::get('/empty', function () {
    Cart::instance('saveForLater')->destroy();
    Cart::instance('default')->destroy();
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});