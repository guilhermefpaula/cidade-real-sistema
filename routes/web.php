<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

#usuarios
$usuarios = App\Http\Controllers\Usuarios\UsersController::class;
Route::get('/usuarios', [$usuarios, 'listar'])->name('usuarios.listar');
Route::get('/usuario/criar', [$usuarios, 'verCriar'])->name('usuarios.ver.criar');
Route::get('/usuario/editar/{id}', [$usuarios, 'verUsuario'])->name('usuarios.ver.editar');
Route::put('/usuario/editar/{id}', [$usuarios, 'editar'])->name('usuarios.editar');
Route::post('/usuario/criar', [$usuarios, 'criar'])->name('usuarios.criar');
Route::get('/usuario/ponto', [$usuarios, 'verPontoStaff'])->name('usuarios.ver.bater.ponto');
Route::post('/usuario/ponto', [$usuarios, 'baterPonto'])->name('usuario.bater.ponto');

#eventos
$eventos = App\Http\Controllers\Eventos\EventosController::class;
Route::get('/eventos', [$eventos, 'listar'])->name('eventos.listar');
Route::get('/eventos/criar', [$eventos, 'verCriar'])->name('eventos.ver.criar');
Route::post('/eventos/criar', [$eventos, 'criar'])->name('eventos.criar');
Route::get('/evento/ver/{id}', [$eventos, 'verEvento'])->name('eventos.ver');
Route::get('/evento/remover/{id}', [$eventos, 'deletarEvento'])->name('eventos.remover');
Route::get('/evento/editar/{id}', [$eventos, 'verEditar'])->name('eventos.ver.editar');
Route::put('/evento/editar/{id}', [$eventos, 'editar'])->name('eventos.editar');
Route::get('/evento/dados', [$eventos, 'buscaDados'])->name('eventos.buscar.dados.ajax');


Route::get('/pontos', [$usuarios, 'verPontos'])->name('ver.pontos');
