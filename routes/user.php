<?php

use Illuminate\Support\Facades\Route;
use Hotash\LaravelMultiUi\Facades\MultiUi;

# Controller Level Namespace
Route::group(['namespace' => 'User', 'as' => 'user.'], function() {

    # User Level Namespace & No Prefix
    MultiUi::routes([
        'URLs' => [
            'login' => 'enter',
            'register' => 'create-user-account',
            'reset/password' => 'reset-pass',
            'logout' => 'getout',
        ],
        'prefix' => [
            'URL' => 'user-',
            'except' => 'register',
        ],
    ]);
    #...
    #...

    Route::group(['prefix' => 'user'], function() {
        # User Level Namespace & 'user' Prefix
        Route::get('/home', 'HomeController@index')->name('home');
        Route::match(['get', 'post'], '/change-password', 'Auth\\ChangePasswordController')
            ->name('password.change');
        Route::match(['get', 'post'], '/edit-profile', 'ProfileController')
            ->name('profile.edit');
        Route::get('example', function() {
            dump('bdsumon4u');
        })->name('example');
        #...
        #...
    });
});

# Controller Level Namespace & No Prefix
#...
#...