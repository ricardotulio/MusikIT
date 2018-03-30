<?php

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'categories', 'namespace' => 'Modules\Categories\Http\Controllers'], function()
{
    Route::get('/', [
        'uses'      => 'CategoriesController@index',
        'as'        => 'categories.show'
    ]);

    Route::get('/create', [
        'uses'      => 'CategoriesController@create',
        'as'        => 'categories.create'
    ]);

    Route::post('/store', [
        'uses'      => 'CategoriesController@store',
        'as'        => 'categories.store'
    ]);

    Route::get('/edit/{id}', [
        'uses'      => 'CategoriesController@edit',
        'as'        => 'categories.edit'
    ]);

    Route::post('/update', [
        'uses'      => 'CategoriesController@update',
        'as'        => 'categories.update'
    ]);

    Route::get('/delete/{id}', [
        'uses'      => 'CategoriesController@destroy',
        'as'        => 'categories.destroy'
    ]);
});
