<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['namespace' => 'Api', 'as' => 'api.'], function () {
    Route::get('products', 'ProductController')->name('products');
    Route::get('images', 'ImageController@index')->name('images.index');
    Route::get('images/single', 'ImageController@single')->name('images.single');
    Route::get('images/multiple', 'ImageController@multiple')->name('images.multiple');
    Route::post('menu/{menu}/sort-items', 'MenuItemSortController')->name('menu-items.sort');
    Route::get('orders', 'OrderController')->name('orders');
});
