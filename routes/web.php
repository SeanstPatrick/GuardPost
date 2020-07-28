<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/payment', function () {
    return view('auth/payment');
});


//'HomeController@security')->name('security');
Route::get('/business','BusinessController@index')->name('business');
Route::get('/security','SecurityController@index')->name('security');

Route::post('/register_business','BusinessController@register')->name('registerbusiness');
Route::post('/post', 'PostController@store')->name('create_post')->middleware('auth');
Route::post('/post-details', 'PostController@pickUp')->middleware('auth');
Route::post('/post-details/approve', 'PostController@update_post_status')->middleware('auth');
Route::post('/post-details/confirm', 'PostController@update_post_status')->middleware('auth');

Route::get('/create', 'PostController@index')->name('create')->middleware('auth');
Route::get('/list', 'PostController@list')->name('list')->middleware('auth');
Route::post('/security_register','SecurityController@register')->name('security_register');

Route::get('/post-details/{id}','PostController@details')->name('post-details')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/security-profile', 'SecurityController@show')->name('security-profile')->middleware('auth');
Route::get('/profile', 'BusinessController@show')->name('profile')->middleware('auth');
