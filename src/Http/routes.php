<?php

Route::group([
    'prefix' => 'admin',
    'namespace' => 'Ognestraz\Admin\Http\Controllers'
    ], function () {

    Route::group(['middleware' => 'auth.admin'], function () {
        
        Route::any('/site/act/{id}', array('uses' => 'SiteController@act'));
        Route::any('/site/restore/{id}', array('uses' => 'SiteController@restore'));
        Route::delete('/site/delete/{id}', array('uses' => 'SiteController@delete'));
        Route::resource('/site', 'SiteController');

        Route::any('/block/create/{id}', array('uses' => 'BlockController@create'));
        Route::any('/block/tree', array('uses' => 'BlockController@tree'));
        Route::any('/block/act/{id}', array('uses' => 'BlockController@act'));
        Route::resource('/block', 'BlockController');

        Route::any('/menu/create/{id}', array('uses' => 'MenuController@create'));
        Route::any('/menu/tree', array('uses' => 'MenuController@tree'));
        Route::any('/menu/act/{id}', array('uses' => 'MenuController@act'));
        Route::resource('/menu', 'MenuController');        
        
        Route::any('/logout', array('uses' => 'MainController@logout'));
    });
    
    Route::any('/', array('uses' => 'MainController@index'));

});