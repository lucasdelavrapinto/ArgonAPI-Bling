<?php


Route::get('/', 'HomeController@index')->name('index');Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('user', 'UserController', ['except' => ['show']]);
    Route::resource('produto', 'ProdutoController', ['except' => ['show']]);

    // Route::get('/produto/api/post', 'ApiController@postProduto')->name('postApiProduto');
    // Route::get('/produtos/api', 'ApiController@getProdutos');

    Route::any('/produtos/api/edit/{codigo}','ApiController@editproduto')->name('editproduto');
    Route::any('/produtos/api/update', 'ApiController@updateProduto')->name('updateproduto');

    Route::any('/produtos/api/deletar/{codigo}', 'ApiController@deleteProduto')->name('apideleteproduto');




	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

