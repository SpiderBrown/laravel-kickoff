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
});