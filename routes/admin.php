<?php
Route::group(['prefix' => '/admin/fanClub', 'namespace' => 'FanClub\\controller\\admin',
    'middleware' => ['web', 'auth:admin']], function () {
        Route::get('index', 'ActionController@index')->name('admin.action.index');
        Route::post('store', 'ActionController@store')->name('admin.action.store');
        Route::get('edit/{id}', 'ActionController@edit')->name('admin.action.edit');
        Route::patch('update', 'ActionController@update')->name('admin.action.update');
        Route::post('change-status', 'ActionController@changeStatus')->name('admin.action.change.status');
    }
);