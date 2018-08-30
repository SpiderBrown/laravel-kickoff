<?php

Route::group(['middleware' => 'web', 'prefix' => 'testmodule', 'namespace' => 'Modules\TestModule\Http\Controllers'], function()
{
    Route::get('/', 'TestModuleController@index');
});
