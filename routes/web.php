<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});


Route::group(['prefix' => 'aluno'], function () {
    Route::get('/', ['uses' => 'AlunoController@index', 'as' => 'aluno.index']);
    Route::get('/incluir', ['uses' => 'AlunoController@incluir', 'as' => 'aluno.incluir']);
    Route::get('/alterar/{id}', ['uses' => 'AlunoController@alterar', 'as' => 'aluno.alterar']);
    Route::post('/salvar', ['uses' => 'AlunoController@salvar', 'as' => 'aluno.salvar']);
    Route::get('/deletar/{id}', ['uses' => 'AlunoController@deletar', 'as' => 'aluno.deletar']);
});

Route::group(['prefix' => 'paciente'], function () {
    Route::get('/', ['uses' => 'PacienteController@index', 'as' => 'paciente.index']);
    Route::get('/form', ['uses' => 'PacienteController@form', 'as' => 'paciente.form']);
    Route::get('/aluno/{id}', ['uses' => 'PacienteController@aluno', 'as' => 'paciente.aluno']);
    Route::post('/salvar', ['uses' => 'PacienteController@salvar', 'as' => 'paciente.salvar']);
    Route::get('/alterar/{id}', ['uses' => 'PacienteController@alterar', 'as' => 'paciente.alterar']);
    Route::get('/deletar/{id}', ['uses' => 'PacienteController@deletar', 'as' => 'paciente.deletar']);
    Route::get('/test', ['uses' => 'PacienteController@test', 'as' => 'paciente.test']);  // - - - - - - - - - // O QUE É ISSO ?
});

Route::group(['prefix' => 'triagem'], function () {
    Route::get('/', ['uses' => 'TriagemController@index', 'as' => 'triagem.index']);
    Route::get('/form', ['uses' => 'TriagemController@form', 'as' => 'triagem.form']);
    Route::get('/form/{id}', ['uses' => 'TriagemController@form', 'as' => 'triagem.form']);
    Route::post('/salvar', ['uses' => 'TriagemController@salvar', 'as' => 'triagem.salvar']);
    Route::get('/alterar/{id}', ['uses' => 'TriagemController@alterar', 'as' => 'triagem.alterar']);
    Route::get('/deletar/{id}', ['uses' => 'TriagemController@deletar', 'as' => 'triagem.deletar']);
});

Route::group(['prefix' => 'supervisor'], function () {
    Route::get('/', ['uses' => 'SupervisorController@index', 'as' => 'supervisor.index']);
    Route::get('/form', ['uses' => 'SupervisorController@form', 'as' => 'supervisor.form']);
    Route::post('/salvar', ['uses' => 'SupervisorController@salvar', 'as' => 'supervisor.salvar']);
    Route::get('/alterar/{id}', ['uses' => 'SupervisorController@alterar', 'as' => 'supervisor.alterar']);
    Route::get('/deletar/{id}', ['uses' => 'SupervisorController@deletar', 'as' => 'supervisor.deletar']);
});
Route::group(['prefix' => 'composicao'], function () {
    Route::get('/', ['uses' => 'ComposicaoController@index', 'as' => 'composicao.index']);
    Route::get('/form', ['uses' => 'ComposicaoController@form', 'as' => 'composicao.form']);
    Route::post('/salvar', ['uses' => 'ComposicaoController@salvar', 'as' => 'composicao.salvar']);
    Route::get('/alterar/{id}', ['uses' => 'ComposicaoController@alterar', 'as' => 'composicao.alterar']);
    Route::get('/deletar/{id}', ['uses' => 'ComposicaoController@deletar', 'as' => 'composicao.deletar']);
});
Route::group(['prefix' => 'Doenca'], function () {
    Route::get('/', ['uses' => 'DoencaController@index', 'as' => 'Doenca.index']);
    Route::get('/form', ['uses' => 'DoencaController@form', 'as' => 'Doenca.form']);
    Route::post('/salvar', ['uses' => 'DoencaController@salvar', 'as' => 'Doenca.salvar']);
    Route::get('/alterar/{id}', ['uses' => 'DoencaController@alterar', 'as' => 'Doenca.alterar']);
    Route::get('/deletar/{id}', ['uses' => 'DoencaController@deletar', 'as' => 'Doenca.deletar']);
});
Route::group(['prefix' => 'DoencaCronica'], function () {
    Route::get('/', ['uses' => 'DoencaCronicaController@index', 'as' => 'DoencaCronica.index']);
    Route::get('/form', ['uses' => 'DoencaCronicaController@form', 'as' => 'DoencaCronica.form']);
    Route::post('/salvar', ['uses' => 'DoencaCronicaController@salvar', 'as' => 'DoencaCronica.salvar']);
    Route::get('/alterar/{id}', ['uses' => 'DoencaCronicaController@alterar', 'as' => 'DoencaCronica.alterar']);
    Route::get('/deletar/{id}', ['uses' => 'DoencaCronicaController@deletar', 'as' => 'DoencaCronica.deletar']);
});
Route::group(['prefix' => 'drogas'], function () {
    Route::get('/', ['uses' => 'DrogasController@index', 'as' => 'drogas.index']);
    Route::get('/form', ['uses' => 'DrogasController@form', 'as' => 'drogas.form']);
    Route::post('/salvar', ['uses' => 'DrogasController@salvar', 'as' => 'drogas.salvar']);
    Route::get('/alterar/{id}', ['uses' => 'DrogasController@alterar', 'as' => 'drogas.alterar']);
    Route::get('/deletar/{id}', ['uses' => 'DrogasController@deletar', 'as' => 'drogas.deletar']);
});

Route::group(['prefix' => 'triagemDrogas'], function () {
    Route::get('/', ['uses' => 'TriagemDrogasController@index', 'as' => 'triagemDrogas.index']);
    Route::get('/form', ['uses' => 'TriagemDrogasController@form', 'as' => 'triagemDrogas.form']);
    Route::post('/salvar', ['uses' => 'TriagemDrogasController@salvar', 'as' => 'triagemDrogas.salvar']);
    Route::get('/alterar/{id}', ['uses' => 'TriagemDrogasController@alterar', 'as' => 'triagemDrogas.alterar']);
    Route::get('/deletar/{id}', ['uses' => 'TriagemDrogasController@deletar', 'as' => 'triagemDrogas.deletar']);
});

Route::group(['prefix' => 'familiar'], function () {
    Route::get('/', ['uses' => 'FamiliarController@index', 'as' => 'familiar.index']);
    Route::get('/form', ['uses' => 'FamiliarController@form', 'as' => 'familiar.form']);
    Route::post('/salvar', ['uses' => 'FamiliarController@salvar', 'as' => 'familiar.salvar']);
    Route::get('/alterar/{id}', ['uses' => 'FamiliarController@alterar', 'as' => 'familiar.alterar']);
    Route::get('/deletar/{id}', ['uses' => 'FamiliarController@deletar', 'as' => 'familiar.deletar']);
});
Route::group(['prefix' => 'gasto'], function () {
    Route::get('/', ['uses' => 'GastoController@index', 'as' => 'gasto.index']);
    Route::get('/form', ['uses' => 'GastoController@form', 'as' => 'gasto.form']);
    Route::post('/salvar', ['uses' => 'GastoController@salvar', 'as' => 'gasto.salvar']);
    Route::get('/alterar/{id}', ['uses' => 'GastoController@alterar', 'as' => 'gasto.alterar']);
    Route::get('/deletar/{id}', ['uses' => 'GastoController@deletar', 'as' => 'gasto.deletar']);
});
Route::group(['prefix' => 'gastoSaude'], function () {
    Route::get('/', ['uses' => 'GastoSaudeController@index', 'as' => 'gastoSaude.index']);
    Route::get('/form', ['uses' => 'GastoSaudeController@form', 'as' => 'gastoSaude.form']);
    Route::post('/salvar', ['uses' => 'GastoSaudeController@salvar', 'as' => 'gastoSaude.salvar']);
    Route::get('/alterar/{id}', ['uses' => 'GastoSaudeController@alterar', 'as' => 'gastoSaude.alterar']);
    Route::get('/deletar/{id}', ['uses' => 'GastoSaudeController@deletar', 'as' => 'gastoSaude.deletar']);
});
Route::group(['prefix' => 'patrimonio'], function () {
    Route::get('/', ['uses' => 'PatrimonioController@index', 'as' => 'patrimonio.index']);
    Route::get('/form', ['uses' => 'PatrimonioController@form', 'as' => 'patrimonio.form']);
    Route::post('/salvar', ['uses' => 'PatrimonioController@salvar', 'as' => 'patrimonio.salvar']);
    Route::get('/alterar/{id}', ['uses' => 'PatrimonioController@alterar', 'as' => 'patrimonio.alterar']);
    Route::get('/deletar/{id}', ['uses' => 'PatrimonioController@deletar', 'as' => 'patrimonio.deletar']);
});
Route::group(['prefix' => 'triagempatrimonio'], function () {
    Route::get('/', ['uses' => 'TriagemPatrimonioController@index', 'as' => 'triagempatrimonio.index']);
    Route::get('/form', ['uses' => 'TriagemPatrimonioController@form', 'as' => 'triagempatrimonio.form']);
    Route::post('/salvar', ['uses' => 'TriagemPatrimonioController@salvar', 'as' => 'triagempatrimonio.salvar']);
    Route::get('/alterar/{id}', ['uses' => 'TriagemPatrimonioController@alterar', 'as' => 'triagempatrimonio.alterar']);
    Route::get('/deletar/{id}', ['uses' => 'TriagemPatrimonioController@deletar', 'as' => 'triagempatrimonio.deletar']);
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

