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

    //Ventas
    Route::resource("productos", "App\Http\Controllers\CRM\Admin\ProductosController");
    Route::resource("ventas", "App\Http\Controllers\CRM\Admin\VentasController");
    Route::get("/vender", "App\Http\Controllers\CRM\Admin\VenderController@index")->name("vender.index");
    Route::post("/productoDeVenta", "App\Http\Controllers\CRM\Admin\VenderController@agregarProductoVenta")->name("agregarProductoVenta");
    Route::delete("/productoDeVenta", "App\Http\Controllers\CRM\Admin\VenderController@quitarProductoDeVenta")->name("quitarProductoDeVenta");
    Route::post("/cancelarVenta", "App\Http\Controllers\CRM\Admin\VenderController@cancelarVenta")->name("cancelarVenta");
    Route::post("/terminarVenta", "App\Http\Controllers\CRM\Admin\VenderController@terminarVenta")->name("terminarVenta");
    Route::post("/terminarOCancelarVenta", "App\Http\Controllers\CRM\Admin\VenderController@terminarOCancelarVenta")->name("terminarOCancelarVenta");
    Route::get('ventas/prospect/{id}', 'App\Http\Controllers\CRM\Ventas\ProspectController@show')->name('sales.prospect');
    Route::get('ventas/prospects', 'App\Http\Controllers\CRM\Ventas\ProspectController@index')->name('sales.prospects'); 

    

	Route::get('admin/projects', 'App\Http\Controllers\CRM\Admin\ProjectController@index')->name('admin.project.show');
	Route::get('admin/projects/create', 'App\Http\Controllers\CRM\Admin\ProjectController@create')->name('admin.project.create');
	Route::get('admin/projects/edit/{id}', 'App\Http\Controllers\CRM\Admin\ProjectController@edit')->name('admin.project.edit');
	Route::post('admin/projects/update/{id}', 'App\Http\Controllers\CRM\Admin\ProjectController@update')->name('admin.project.update');
	Route::get('admin/projects/delete/{id}', 'App\Http\Controllers\CRM\Admin\ProjectController@destroy')->name('admin.project.delete');	
	Route::post('admin/projects/store', 'App\Http\Controllers\CRM\Admin\ProjectController@store')->name('admin.project.store');




	Route::get('admin/tasks','App\Http\Controllers\CRM\Admin\TaskController@index')->name('admin.task.show');
	Route::get('admin/tasks/view/{id}','App\Http\Controllers\CRM\Admin\TaskController@view')->name('admin.task.view');
	Route::get('admin/tasks/create', 'App\Http\Controllers\CRM\Admin\TaskController@create')->name('admin.task.create'); 
	Route::post('admin/tasks/store', 'App\Http\Controllers\CRM\Admin\TaskController@store')->name('admin.task.store');
	Route::get('admin/tasks/search', 'App\Http\Controllers\CRM\Admin\TaskController@searchTask')->name('admin.task.search');
	Route::get('admin/tasks/sort/{key}', 'App\Http\Controllers\CRM\Admin\TaskController@sort')->name('admin.task.sort');
    Route::get('admin/tasks/edit/{id}','App\Http\Controllers\CRM\Admin\TaskController@edit')->name('admin.task.edit');

	Route::get('admin/tasks/edit/{id}', function () {	
	    'uses' => 'TaskController@edit',
	    'as'  => 'task.edit'
	 });

	Route::get('admin/tasks/list/{projectid}','App\Http\Controllers\CRM\Admin\TaskController@tasklist')->name('admin.task.list');
	Route::get('admin/tasks/delete/{id}', 'App\Http\Controllers\CRM\Admin\TaskController@destroy')->name('admin.task.delete') ;
	Route::get('admin/tasks/deletefile/{id}', 'App\Http\Controllers\CRM\Admin\TaskController@deleteFile')->name('admin.task.deletefile') ;
	Route::post('admin/tasks/update/{id}', 'App\Http\Controllers\CRM\Admin\TaskController@update')->name('admin.task.update') ;
	Route::get('admin/tasks/completed/{id}','App\Http\Controllers\CRM\Admin\TaskController@completed')->name('admin.task.completed');
    Route::get('/users/list/{id}','App\Http\Controllers\CRM\Admin\UsersController@userTaskList')->name('admin.user.list');


});
//Sales-Prospects


Route::group(['middleware'=>['auth','isVentas']], function() {

    
    //Sales-Clients
    Route::get('ventas/client/{id}', 'App\Http\Controllers\CRM\Ventas\ClientController@show')->name('sales.client');
    Route::get('ventas/clients', 'App\Http\Controllers\CRM\Ventas\ClientController@index')->name('sales.clients');   

    //Sales-Sales
    Route::resource("ventas/ventas", "App\Http\Controllers\CRM\Ventas\VentasController",['as' => 'sales']);
    Route::get("ventas/vender", "App\Http\Controllers\CRM\Ventas\VenderController@index")->name("sales.vender.index");
    Route::post("ventas/productoDeVenta", "App\Http\Controllers\CRM\Ventas\VenderController@agregarProductoVenta")->name("sales.agregarProductoVenta");
    Route::delete("ventas/productoDeVenta", "App\Http\Controllers\CRM\Ventas\VenderController@quitarProductoDeVenta")->name("sales.quitarProductoDeVenta");
    Route::post("ventas/cancelarVenta", "App\Http\Controllers\CRM\Ventas\VenderController@cancelarVenta")->name("sales.cancelarVenta");
    Route::post("ventas/terminarVenta", "App\Http\Controllers\CRM\Ventas\VenderController@terminarVenta")->name("sales.terminarVenta");
    Route::post("ventas/terminarOCancelarVenta", "App\Http\Controllers\CRM\Ventas\VenderController@terminarOCancelarVenta")->name("sales.terminarOCancelarVenta");


});

Route::group(['middleware'=>['auth','isMarketing']], function() {

    //Marketing-Prospects
    Route::get('marketing/prospect/{id}', 'App\Http\Controllers\CRM\Marketing\ProspectController@show')->name('marketing.prospect');
    Route::get('marketing/prospects', 'App\Http\Controllers\CRM\Marketing\ProspectController@index')->name('marketing.prospects');
  
    //Marketing-Clients
    Route::get('marketing/client/{id}', 'App\Http\Controllers\CRM\Marketing\ClientController@show')->name('marketing.client');
    Route::get('marketing/clients', 'App\Http\Controllers\CRM\Marketing\ClientController@index')->name('marketing.clients'); 

});

Route::group(['middleware'=>['auth']], function() {   
   
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');  
});

 