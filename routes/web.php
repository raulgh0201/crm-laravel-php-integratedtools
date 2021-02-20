<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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
    return view('auth.register');
});

Auth::routes(['verify'=> true]);
Route::get('home', 'App\Http\Controllers\HomeController@index')->name('home');;

// ------------------------------register---------------------------------------
Route::get('/register', 'App\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'App\Http\Controllers\Auth\RegisterController@register')->name('register');

// -----------------------------login-----------------------------------------
Route::get('/login', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login');
Route::get('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');

// -----------------------------forget password ------------------------------
Route::get('forget-password', 'App\Http\Controllers\Auth\ForgotPasswordController@getEmail')->name('forget-password');
Route::post('forget-password', 'App\Http\Controllers\Auth\ForgotPasswordController@postEmail')->name('forget-password');

Route::get('reset-password/{token}', 'App\Http\Controllers\Auth\ResetPasswordController@getPassword');
Route::post('reset-password', 'App\Http\Controllers\Auth\ResetPasswordController@updatePassword');

// -----------------------------login socialite ------------------------------
Route::get('oauth/{driver}', 'App\Http\Controllers\Auth\LoginController@redirectToProvider')->name('social.oauth');
Route::get('oauth/{driver}/callback', 'App\Http\Controllers\Auth\LoginController@handleProviderCallback')->name('social.callback');

