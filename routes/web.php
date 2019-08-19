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

Route::get('admin', function () {
    return view('admin.pages.index');
});
Route::get('/', 'HomeController@index');
Route::get('getProductType','AjaxController@getProductType');
Route::group(['prefix' => 'admin'], function () {
    Route::resource('category', 'CategoryController');
    Route::resource('product_type', 'ProductTypeController');
    Route::resource('product', 'ProductController');

    Route::post('updateProduct/{id}','ProductController@update');
});

Route::get('callback/{social}', 'UserController@handleProviderCallback');
Route::get('login/{social}','UserController@redirectProvider')->name('login.social');
Route::get('logout','UserController@logout');
Route::post('updatepass','UserController@updatePass')->name('updatepasswordClient');
Route::post('login','UserController@loginClient');
Route::post('register','UserController@register')->name('registerClient');
