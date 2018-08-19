<?php

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
})->name('root');

Route::get('/social/{provider}/login','Auth\SocialController@redirectToProvider')->name("social.login");
Route::get('/social/{provider}/callback', 'Auth\SocialController@handleProviderCallback');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin'], function() {

    Route::group(['prefix' => 'roles', 'middleware' => ['role:superadministrator|administrator']], function () { //,'permission:access-role'
        Route::get('/', 'Admin\RoleController@index')->name("roles.index"); //read all
        Route::get('/create', 'Admin\RoleController@create')->name("roles.create"); //show create page
        Route::post('/', 'Admin\RoleController@store')->name("roles.store"); //create
        Route::get('/{id}', 'Admin\RoleController@show')->name("roles.show"); //read one
        Route::get('/{id}/edit', 'Admin\RoleController@edit')->name("roles.edit"); //update page show
        Route::post('/{id}', 'Admin\RoleController@update')->name("roles.update"); //update
        Route::get('/{id}/delete', 'Admin\RoleController@destroy')->name("roles.destroy"); //delete
    });

    Route::group(['prefix' => 'permissions', 'middleware' => ['role:superadministrator|administrator']], function () {
        Route::get('/', 'Admin\PermissionController@index')->name("permissions.index");
        Route::get('/create', 'Admin\PermissionController@create')->name("permissions.create");
        Route::post('/', 'Admin\PermissionController@store')->name("permissions.store");
        Route::get('/{id}', 'Admin\PermissionController@show')->name("permissions.show");
        Route::get('/{id}/edit', 'Admin\PermissionController@edit')->name("permissions.edit");
        Route::post('/{id}', 'Admin\PermissionController@update')->name("permissions.update");
        Route::get('/{id}/delete', 'Admin\PermissionController@destroy')->name("permissions.destroy");
    });
    Route::group(['prefix' => 'users', 'middleware' => ['role:superadministrator|administrator']], function () {
        Route::get('/', 'Admin\UserController@index')->name("users.index");
        Route::get('/create', 'Admin\UserController@create')->name("users.create");
        Route::post('/', 'Admin\UserController@store')->name("users.store");
        Route::get('/{id}', 'Admin\UserController@show')->name("users.show");
        Route::get('/{id}/edit', 'Admin\UserController@edit')->name("users.edit");
        Route::post('/{id}', 'Admin\UserController@update')->name("users.update");
        Route::get('/{id}/delete', 'Admin\UserController@destroy')->name("users.destroy");
    });
});



Route::get('/notify', function () {
    $user=Auth::user();
    echo $user->name;
    echo $user->UnreadNotifications->groupBy('type')->count();
    return $user->notify(new \App\Notifications\WelcomeMessage());
});