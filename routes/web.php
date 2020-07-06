<?php

Route::get('/', 'HomeController@index')->name('home');

Route::get('/detail', 'DetailController@index')->name('detail');

Route::get('/checkout', 'CheckoutController@index')->name('checkout');

Route::get('/checkout/success', 'CheckoutController@success')->name('checkout.success');


Route::prefix('admin')->namespace('Admin')->group(function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
});
