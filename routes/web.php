<?php

use Illuminate\Support\Facades\Artisan;
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

Route::get('/loginSmile/{phpsesid}', 'TestController@loginSmile');
Route::get('/createPayment', 'TestController@createPayment');

Route::get('/', 'LandingController@index')->name('landing');
Route::get('/faq', 'LandingController@faq')->name('landing.faq');
Route::get('/about-us', 'LandingController@aboutUs')->name('landing.aboutus');
Route::get('/cara-order', 'LandingController@caraOrder')->name('landing.caraorder');
Route::get('/fetch/products', 'LandingController@allProducts')->name('fetch.products');
Route::get('/detail/{id}', 'LandingController@detail');
Route::post('/add-cart', 'LandingController@addCart')->name('add.cart');
Route::post('/checkout/store', 'LandingController@checkout')->name('checkout.store');
Route::get('/add-information', 'LandingController@userInformationCheckout')->name('fill.user');

Route::get('/upload/{trx}', 'LandingController@upload');
Route::post('/checkout/upload', 'CheckoutController@upload')->name('checkout.upload');

Route::get('/artisan', function () {
    Artisan::call('storage:link');
});

Route::prefix('/admin')->group(function () {
    Auth::routes();

    Route::middleware('auth')->group(function () {
        Route::get('/', 'HomeController@index')->name('home');

        Route::resource('/category', 'CategoryController');

        Route::post('/product/image', 'ProductController@ImageProduct')->name('product.image');
        Route::resource('/product', 'ProductController');

        Route::resource('/testimoni', 'TestimoniController');

        Route::get('/profile', 'HomeController@profile')->name('profile.index');
        Route::post('/profile/{profile}', 'HomeController@updateProfile')->name('profile.update');

        Route::get('/settings', 'SettingsController@index')->name('settings.index');
        Route::post('/settings', 'SettingsController@update')->name('settings.update');

        Route::get('/about-us', 'SettingsController@aboutUs')->name('aboutus.index');
        Route::get('/cara-order', 'SettingsController@caraOrder')->name('caraorder.index');
        Route::post('/about-us', 'SettingsController@updateAboutUs')->name('aboutus.update');
        Route::post('/cara-order', 'SettingsController@updateCaraOrder')->name('caraorder.update');

        Route::get('/users', 'UserController@index')->name('users.index');
        Route::delete('/users/{id}', 'UserController@destroy')->name('users.destroy');

        Route::get('/checkout', 'CheckoutController@index')->name('checkout.index');
        Route::delete('/checkout/{id}', 'CheckoutController@destroy')->name('checkout.destroy');

        Route::resource('/faq', 'FAQController');
    });
});
