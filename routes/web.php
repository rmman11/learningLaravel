<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\GoogleController;

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


date_default_timezone_set('Europe/Bucharest');



Route::get('/', [App\Http\Controllers\TestController::class, 'index'])->name('welcome');

Route::post('/user/register',array('uses'=>'UserRegistration@postRegister'));
Route::get('/about', [App\Http\Controllers\TestController::class, 'about'])->name('about');
Route::get('/login', function () {
  return view('/admin/login');
});



Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);

Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);


/*
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
  return view('dashboard');
})->name('dashboard');

Route::controller(GoogleController::class)->group(function(){
  Route::get('auth/google', 'redirectToGoogle')->name('auth.google');
  Route::get('auth/google/callback', 'handleGoogleCallback');
});*/

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/contact', [App\Http\Controllers\ContactController::class, 'contact'])->name('contact');
Route::post('/contact', ['as'=>'contactus.store','uses'=>'ContactController@contactUSPost']);
Route::get('/video', [App\Http\Controllers\HomeController::class, 'video'])->name('video');

Route::get('/fqa', [App\Http\Controllers\HomeController::class, 'fqa'])->name('fqa');






Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin'],function() {

  Route::middleware('auth:admin')->group(function() {




      Route::get('/dashboard', 'DashboardController@index')->name('dashboard');


  Route::get('profile/profile', 'DashboardController@profile')->name('profile.profile');
  Route::resource('profile', 'DashboardController');



        Route::get('profile', 'UsersController@profile')->name('profile');
      //  Route::resource('profile', 'AdminUserController');


        //for task

        Route::get('/tasks','TaskController@index')->name('task');

        Route::get('/show/{id}','TaskController@show')->name('show');





        Route::delete('/tasks/destroy', 'TaskController@destroy')->name('tasks.destroy');
        Route::resource('/tasks', 'TaskController');




        //for photo option in admin
        		Route::get('/photos', 'ImageController@index')->name('photos.index');
        		Route::get('/photos', 'ImageController@create')->name('photos.create');
        		Route::delete('/photos/{id}', 'ImageController@destroy')->name('photos.destroy');
        		Route::resource('/photos', 'ImageController');






        Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
        Route::resource('permissions', 'PermissionsController');


        // Users

        Route::get('/users','UsersController@index')->name('index');
        Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
        Route::resource('/users', 'UsersController');


        // CategoryController categories
        Route::get('/categories','CategoryController@index')->name('index');
        Route::delete('categories/destroy', 'CategoryController@destroy')->name('categories.destroy');
        Route::resource('categories', 'CategoryController');



           // Clientstatuses


      Route::get('/','ClientStatusController@index')->name('clientStatuses.index');
      Route::delete('clientStatuses/destroy', 'ClientStatusController@massDestroy')->name('clientStatuses.massDestroy');
      Route::resource('clientStatuses', 'ClientStatusController');




       // Clients


         Route::delete('clients/destroy', 'ClientController@massDestroy')->name('clients.massDestroy');
         Route::resource('clients', 'ClientController');

        // Roles
         Route::get('/','RolesController@index')->name('roles.index');
        Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
        Route::resource('roles', 'RolesController');

        // Products
        Route::delete('products/destroy', 'ProductController@destroy')->name('products.massDestroy');
        Route::resource('products', 'ProductController');

        // Orders
        Route::get('/index', 'OrderController@index')->name('orders.index');
        Route::get('/{orders}/show', 'OrderController@show')->name('orders.show');
        Route::delete('orders/destroy', 'OrdersController@massDestroy')->name('orders.massDestroy');
        Route::resource('orders', 'OrdersController');

          Route::post('/admin/logout','AdminUserController@logout')->name('logout');


  });


	Route::get('/admin/login',  [App\Http\Controllers\AdminUserController::class, 'login'])->name("login");

	Route::resource('/login', 'AdminUserController');
  });

  /*---------------end the admin part ----------------------*/
