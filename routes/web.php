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

Auth::routes();

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
Route::get('admin/prospect/{id}', 'App\Http\Controllers\CRM\Admin\ProspectController@show')->name('admin.prospect');



Route::group(['middleware'=>['auth','isAdmin']], function() {

    //Employees
    Route::get('admin/users', 'App\Http\Controllers\CRM\Admin\UsersController@index')->name('admin.users');
    Route::get('admin/user/{id}', 'App\Http\Controllers\CRM\Admin\UsersController@getUser')->name('admin.user');
    Route::post('admin/users/store', 'App\Http\Controllers\CRM\Admin\UsersController@store')->name('admin.user.store');
    Route::get('admin/users/delete/{id}', 'App\Http\Controllers\CRM\Admin\UsersController@store')->name('admin.user.destroy');
    Route::put('admin/user/update', 'App\Http\Controllers\CRM\Admin\UsersController@update')->name('admin.user.update');

    //Prospects
    Route::get('admin/prospect/{id}', 'App\Http\Controllers\CRM\Admin\ProspectController@show')->name('admin.prospect');
    Route::get('admin/prospects', 'App\Http\Controllers\CRM\Admin\ProspectController@index')->name('admin.prospects');
    Route::post('admin/prospect/store', 'App\Http\Controllers\CRM\Admin\ProspectController@store')->name('admin.prospect.store');
    Route::get('admin/prospect/delete/{id}', 'App\Http\Controllers\CRM\Admin\ProspectController@destroy')->name('admin.prospect.destroy');
    Route::put('admin/prospect/update', 'App\Http\Controllers\CRM\Admin\ProspectController@update')->name('admin.prospect.update');

    //Contacts
    Route::get('admin/contact/{id}', 'App\Http\Controllers\CRM\Admin\ContactController@show')->name('admin.contact');
    Route::get('admin/contacts', 'App\Http\Controllers\CRM\Admin\ContactController@index')->name('admin.contacts'); 
    Route::post('admin/contact/store', 'App\Http\Controllers\CRM\Admin\ContactController@store')->name('admin.contact.store');
    Route::get('admin/contact/delete/{id}', 'App\Http\Controllers\CRM\Admin\ContactController@destroy')->name('admin.contact.destroy');
    Route::put('admin/contact/update', 'App\Http\Controllers\CRM\Admin\ContactController@update')->name('admin.contact.update');

    //Clients
    Route::get('admin/client/{id}', 'App\Http\Controllers\CRM\Admin\ClientController@show')->name('admin.client');
    Route::get('admin/clients', 'App\Http\Controllers\CRM\Admin\ClientController@index')->name('admin.clients'); 
    Route::post('admin/client/store', 'App\Http\Controllers\CRM\Admin\ClientController@store')->name('admin.client.store');
    Route::get('admin/client/delete/{id}', 'App\Http\Controllers\CRM\Admin\ClientController@destroy')->name('admin.client.destroy');
    Route::put('admin/client/update', 'App\Http\Controllers\CRM\Admin\ClientController@update')->name('admin.client.update');

});

Route::group(['middleware'=>['auth']], function() {

    //Employees
    Route::get('user/users', 'App\Http\Controllers\CRM\User\UsersController@index')->name('user.users');

    //Prospects
    Route::get('user/prospect/{id}', 'App\Http\Controllers\CRM\User\ProspectController@show')->name('user.prospect');
    Route::get('user/prospects', 'App\Http\Controllers\CRM\User\ProspectController@index')->name('user.prospects');

    //Clients
    Route::get('user/client/{id}', 'App\Http\Controllers\CRM\User\ClientController@show')->name('user.client');
    Route::get('user/clients', 'App\Http\Controllers\CRM\User\ClientController@index')->name('user.clients'); 
    
    
    //Proyects

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/inbox', 'App\Http\Controllers\InboxController@index')->name('inbox');
    Route::get('/inbox/{id}', [InboxController::class, 'show'])->name('inbox.show');
    
    
    
});

 