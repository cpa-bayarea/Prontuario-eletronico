<?php


Auth::routes();

//    $this::get('/', function () {
//        return view('welcome');
//    });

Route::group(['middleware' => 'auth'], function () {

//    // After put this URL above the route group.
//    $this::get('/', function () {
//        return view('home');
//    });
    # todo => Gambi para levar para o login, refatorar depois
    $this::get('/', 'HomeController@index')->name('home');
    $this::get('/home', 'HomeController@index')->name('home');

    Route::resource('user', 'UserController');

    // Route::resource('linha_teorica', 'LinhaTeoricaController');
    $this::group(['prefix' => 'linha_teorica'], function () {
        $this::get('/index',        ['uses' => 'LinhaTeoricaController@index',   'as' => 'linha.index']);
        $this::get('/form',         ['uses' => 'LinhaTeoricaController@create',  'as' => 'linha.create']);
        $this::post('/store',       ['uses' => 'LinhaTeoricaController@store',   'as' => 'linha.store']);
        $this::get('/edit/{id}',    ['uses' => 'LinhaTeoricaController@edit',    'as' => 'linha.edit']);
        $this::get('/destroy/{id}', ['uses' => 'LinhaTeoricaController@destroy', 'as' => 'linha.destroy']);
    });

    $this::group(['prefix' => 'demandantes'], function () {
        $this::get('/index',        ['uses' => 'DemandantesController@index',   'as' => 'demandantes.index']);
        $this::get('/form',         ['uses' => 'DemandantesController@create',  'as' => 'demandantes.create']);
        $this::post('/store',       ['uses' => 'DemandantesController@store',   'as' => 'demandantes.store']);
        $this::get('/edit/{id}',    ['uses' => 'DemandantesController@edit',    'as' => 'demandantes.edit']);
        $this::get('/destroy/{id}', ['uses' => 'DemandantesController@destroy', 'as' => 'demandantes.destroy']);
    });

});
