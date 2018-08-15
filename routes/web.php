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

Route::get('/home', function () {
    echo 'welcome home ';
    if(Laratrust::user()) {
        Debugbar::info('logged user access '.Laratrust::user()->name);
        echo Laratrust::user()->name;
    }else {
        Debugbar::warning('Guest user access');
        echo 'guest';
    }
});

Route::get('/social/{provider}/login','Auth\SocialController@redirectToProvider')->name("social.login");
Route::get('/social/{provider}/callback', 'Auth\SocialController@handleProviderCallback');