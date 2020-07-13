<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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
    return view('welcome');
});

Auth::routes();

Route::get('/Dashboard', 'DashboardController@index')->name('Dashboard');


Route::get('/CadastrarBanca', 'CadastrobancaController@index')->name('Cadastrobanca');

Route::get('/CadastroTradingPlan', 'CadastroTradingPlanController@index')->name('CadastroTradingPlan');
Route::post('/CadastroTradingPlan',  'CadastroTradingPlanController@save')->name('CadastroTradingPlan.save');
Route::get('/ListTradingPlan', 'ListTradingPlanController@index')->name('ListTradingPlan');

Route::get('/CadastroEstrategia', 'CadastroEstrategiaController@index')->name('CadastroEstrategia');
Route::get('/ListEstrategia', 'ListEstrategiaController@index')->name('ListEstrategia');
Route::get('/EditarEstrategia{params?}', 'ListEstrategiaController@index')->name('ListEstrategia.edit');
Route::get('/DeletarEstrategia', 'ListEstrategiaController@edit')->name('ListEstrategia.destroy');
Route::post('/CadastroEstrategia',  'CadastroEstrategiaController@save')->name('CadastroEstrategia.save');


Route::DELETE('/Operacoes.delete.id={id}', 'ImportController@destroy')-> name('operacoes.destroy');
Route::DELETE('/Operacoes.delete.email={email}', 'ImportController@destroyall')->name('operacoes.destroyall');



Route::post('/import_Operacoes', 'ImportController@import_operacoes')-> name('ImportarOperacoes.save');
Route::get('/file/ModeloOperacoes', 'ImportController@modeloOperacoes')->name('ModeloOperacoes');
Route::get('/Cadastrar_Operacao', 'ImportController@cadastrarOperacoes')-> name('CadastrarOperacoes');
Route::any('/filtro_operacoes',  'ImportController@searchFiltro')-> name('filtro_operacoes.search');

Route::get('/Operacoes.edit', 'ImportController@editarOperacoes')-> name('operacoes.edit');
Route::get('/Operacoes.delete', 'ImportController@deletarOperacoes')-> name('operacoes.delete');
Route::PUT('/Operacoes.update.id={id}', 'ImportController@update')-> name('operacoes.update');


Route::get('/CadastrarCorretora',  'ImportarCorretoraController@index')-> name('CadastrarCorretora');
Route::post('/ImportarCorretora',  'ImportarCorretoraController@save')-> name('ImportarCorretora.save');


Route::group(['prefix' => 'api'], function() {
    //Route::get('/charts_operacoes',  'ApiCharts\ChartsController@operacoes')-> name('charts_operacoes');
    Route::get('/charts_resultado{params?}',  'ApiCharts\ChartsController@resultado')-> name('charts_resultado');
    Route::get('/charts_operacoes{params?}',  'ApiCharts\ChartsController@operacoes')-> name('charts_operacoes');
    Route::get('/charts_estrategia{params?}',  'ApiCharts\ChartsController@estrategia')-> name('charts_estrategia');



    Route::get('/charts_ativo{params?}',  'ApiCharts\ChartsController@ativo')-> name('ativo_filtro');



});





