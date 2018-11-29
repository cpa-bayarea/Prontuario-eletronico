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

    $this::group(['prefix' => 'supervisor'], function () {
        $this::get('/index',        ['uses' => 'SupervisorController@index',   'as' => 'supervisor.index']);
        $this::get('/form',         ['uses' => 'SupervisorController@create',  'as' => 'supervisor.create']);
        $this::post('/store',       ['uses' => 'SupervisorController@store',   'as' => 'supervisor.store']);
        $this::get('/edit/{id}',    ['uses' => 'SupervisorController@edit',    'as' => 'supervisor.edit']);
        $this::get('/destroy/{id}', ['uses' => 'SupervisorController@destroy', 'as' => 'supervisor.destroy']);
    });

});
//$this::get('/register', 'HomeController@reg')->name('reg');

//$this::group(['prefix' => 'user'], function () {
//    $this::get('/register',      ['uses' => 'UserController@create',   'as' => 'newuser']);
//        $this::get('/form',         ['uses' => 'SupervisorController@create',  'as' => 'supervisor.create']);
//        $this::post('/store',       ['uses' => 'SupervisorController@store',   'as' => 'supervisor.store']);
//        $this::get('/edit/{id}',    ['uses' => 'SupervisorController@edit',    'as' => 'supervisor.edit']);
//        $this::get('/destroy/{id}', ['uses' => 'SupervisorController@destroy', 'as' => 'supervisor.destroy']);
//});