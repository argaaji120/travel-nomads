<?php

/**
 *  Home
 */
Route::get('/', 'HomeController@index')->name('home');

/**
 *  Detail
 */
Route::get('/detail', 'DetailController@index')->name('detail');

/**
 *  Checkout
 */
Route::get('/checkout', 'CheckoutController@index')->name('checkout');
Route::get('/checkout/success', 'CheckoutController@success')->name('checkout.success');

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
