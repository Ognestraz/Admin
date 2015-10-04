<?php

Route::group([
    'prefix' => 'admin',
    'namespace' => 'Ognestraz\Admin\Http\Controllers'
    ], function () {

    Route::group(['middleware' => 'auth.admin'], function () {
        
        Route::any('/site/tree', array('uses' => 'SiteController@tree'));
        Route::any('/site/template/{id}', array('uses' => 'SiteController@template'));
        Route::any('/site/settings/{id}', array('uses' => 'SiteController@settings'));
        Route::any('/site/reimage/{id}', array('uses' => 'SiteController@reimage'));
        Route::any('/site/create/{id}', array('uses' => 'SiteController@create'));        
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