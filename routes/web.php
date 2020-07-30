<?php

Route::get('/', 'HomeController@index')->name('home');

Route::get('/detail', 'DetailController@index')->name('detail');

Route::get('/checkout', 'CheckoutController@index')->name('checkout');

Route::get('/checkout/success', 'CheckoutController@success')->name('checkout.success');


Route::prefix('admin')->namespace('Admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');
});

Auth::routes(['verify' => true]);
