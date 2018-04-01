<?php

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'products', 'namespace' => 'Modules\Products\Http\Controllers'], function()
{
    Route::get('/', [
        'uses'      => 'ProductsController@index',
        'as'        => 'products.show'
    ]);

    Route::get('/create', [
        'uses'      => 'ProductsController@create',
        'as'        => 'products.create'
    ]);

    Route::post('/store', [
        'uses'      => 'ProductsController@store',
        'as'        => 'products.store'
    ]);

    Route::get('/edit/{id}', [
        'uses'      => 'Product\StoreProductHandler',
        'as'        => 'products.edit'
    ]);

    Route::post('/update', [
        'uses'      => 'ProductsController@update',
        'as'        => 'products.update'
    ]);

    Route::get('/delete/{id}', [
        'uses'      => 'ProductsController@destroy',
        'as'        => 'products.destroy'
    ]);
});
