<?php

Route::group(['prefix' => 'acl', 'namespace' => 'Ognestraz\Admin\Http\Controllers'], function () {

    Route::get('/', ['as' => 'admin.index', 'uses' => 'AdminController@index']);

});
