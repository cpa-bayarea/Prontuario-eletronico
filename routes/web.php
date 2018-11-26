<?php


Auth::routes();


Route::group(['middleware' => 'auth'], function () {

    // After put this URL above the route group.
    $this::get('/', function () {
        return view('welcome');
    });

    Route::resource('user', 'UserController');

    $this::group(['prefix' => 'tipo_projeto'], function () {
        $this::get('/index',        ['uses' => 'TipoProjetosController@index',   'as' => 'tipo_projeto.index']);
        $this::get('/form',         ['uses' => 'TipoProjetosController@create',  'as' => 'create']);
        $this::post('/store',       ['uses' => 'TipoProjetosController@store',   'as' => 'tipo_projeto.store']);
        $this::get('/edit/{id}',    ['uses' => 'TipoProjetosController@edit',    'as' => 'tipo_projeto.edit']);
        $this::get('/destroy/{id}', ['uses' => 'TipoProjetosController@destroy', 'as' => 'destroy']);
    });

    $this::group(['prefix' => 'demandantes'], function () {
        $this::get('/index',        ['uses' => 'DemandantesController@index',   'as' => 'demandantes.index']);
        $this::get('/form',         ['uses' => 'DemandantesController@create',  'as' => 'demandantes.create']);
        $this::post('/store',       ['uses' => 'DemandantesController@store',   'as' => 'demandantes.store']);
        $this::get('/edit/{id}',    ['uses' => 'DemandantesController@edit',    'as' => 'demandantes.edit']);
        $this::get('/destroy/{id}', ['uses' => 'DemandantesController@destroy', 'as' => 'demandantes.destroy']);
    });

    $this::group(['prefix' => 'perfil'], function () {
        $this::get('/index',        ['uses' => 'PerfilController@index',   'as' => 'perfil.index']);
        $this::get('/form',         ['uses' => 'PerfilController@create',  'as' => 'perfil.create']);
        $this::post('/store',       ['uses' => 'PerfilController@store',   'as' => 'perfil.store']);
        $this::get('/edit/{id}',    ['uses' => 'PerfilController@edit',    'as' => 'perfil.edit']);
        $this::get('/destroy/{id}', ['uses' => 'PerfilController@destroy', 'as' => 'perfil.destroy']);
    });

    $this::group(['prefix' => 'cargo'], function () {
        $this::get('/index',        ['uses' => 'CargoController@index',   'as' => 'cargo.index']);
        $this::get('/form',         ['uses' => 'CargoController@create',  'as' => 'cargo.create']);
        $this::post('/store',       ['uses' => 'CargoController@store',   'as' => 'cargo.store']);
        $this::get('/edit/{id}',    ['uses' => 'CargoController@edit',    'as' => 'cargo.edit']);
        $this::get('/destroy/{id}', ['uses' => 'CargoController@destroy', 'as' => 'cargo.destroy']);
    });

    $this::group(['prefix' => 'projeto'], function () {
        $this::get('/index',        ['uses' => 'ProjetoController@index',   'as' => 'projeto.index']);
        $this::get('/form',         ['uses' => 'ProjetoController@create',  'as' => 'projeto.create']);
        $this::post('/store',       ['uses' => 'ProjetoController@store',   'as' => 'projeto.store']);
        $this::get('/edit/{id}',    ['uses' => 'ProjetoController@edit',    'as' => 'projeto.edit']);
        $this::get('/destroy/{id}', ['uses' => 'ProjetoController@destroy', 'as' => 'projeto.destroy']);
    });

    $this::get('/home', 'HomeController@index')->name('home');

});
