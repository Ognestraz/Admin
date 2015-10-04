<?php

Route::group([
    'prefix' => 'admin',
    'namespace' => 'Ognestraz\Admin\Http\Controllers'
    ], function () {

    Route::group(['middleware' => 'auth.admin'], function () {
        Route::any('/site/tree', array('uses' => 'SiteController@tree'));
        Route::any('/site/create/{id}', array('uses' => 'SiteController@create'));    

        Route::resource('/site', 'SiteController');
        Route::any('/logout', array('uses' => 'MainController@logout'));
    });
    
    Route::any('/', array('uses' => 'MainController@index'));

});