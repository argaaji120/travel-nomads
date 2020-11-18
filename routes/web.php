<?php

/**
 *  Home
 */
Route::get('/', 'HomeController@index')->name('home');

/**
 *  Detail
 */
Route::get('/detail/{slug}', 'DetailController@index')->name('detail');

/**
 *  Checkout
 */
Route::prefix('checkout')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/{id}', 'CheckoutController@index')->name('checkout');

    Route::post('/{id}', 'CheckoutController@process')->name('checkout.process');

    Route::post('/create/{detail_id}', 'CheckoutController@create')->name('checkout.create');

    Route::get('/remove/{detail_id}', 'CheckoutController@remove')->name('checkout.remove');

    Route::get('/confirm/{id}', 'CheckoutController@success')->name('checkout.success');
});

/**
 *  Admin
 */
Route::prefix('admin')->namespace('Admin')->middleware(['auth', 'admin'])->group(function () {
    // Dashboard
    Route::get('/', 'DashboardController@index')->name('dashboard');

    // Travel Packages
    Route::resource('travel-package', 'TravelPackageController');

    // Gallery Travel Packages
    Route::resource('gallery', 'GalleryController');

    // Transaction
    Route::resource('transaction', 'TransactionController');
});

Auth::routes(['verify' => true]);
