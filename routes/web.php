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

    $this::group(['prefix' => 'perfil'], function () {
        $this::get('/index',        ['uses' => 'PerfilController@index',   'as' => 'perfil.index']);
        $this::get('/form',         ['uses' => 'PerfilController@create',  'as' => 'perfil.create']);
        $this::post('/store',       ['uses' => 'PerfilController@store',   'as' => 'perfil.store']);
        $this::get('/edit/{id}',    ['uses' => 'PerfilController@edit',    'as' => 'perfil.edit']);
        $this::get('/destroy/{id}', ['uses' => 'PerfilController@destroy', 'as' => 'perfil.destroy']);
    });

    $this::group(['prefix' => 'demandantes'], function () {
        $this::get('/index',        ['uses' => 'DemandantesController@index',   'as' => 'demandantes.index']);
        $this::get('/form',         ['uses' => 'DemandantesController@create',  'as' => 'demandantes.create']);
        $this::post('/store',       ['uses' => 'DemandantesController@store',   'as' => 'demandantes.store']);
        $this::get('/edit/{id}',    ['uses' => 'DemandantesController@edit',    'as' => 'demandantes.edit']);
        $this::get('/destroy/{id}', ['uses' => 'DemandantesController@destroy', 'as' => 'demandantes.destroy']);
    });

});
