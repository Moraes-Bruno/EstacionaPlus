<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VagaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EstacionamentoController;
use App\Http\Controllers\UsuarioController;
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



Route::get('/', [EstacionamentoController::class, 'show']);
Route::get('/admin', [AdminController::class, 'show']);
Route::get('/admin/usuarios', [UsuarioController::class, 'listar'])->name('usuarios.listar');
Route::post('/admin/usuarios/inserir', [UsuarioController::class, 'inserir'])->name('usuario.inserir');
Route::get('/admin/usuarios/form/{_id?}', [UsuarioController::class, 'usuarios_form'])->name('usuario.form');
Route::put('/admin/usuarios/alterar/{_id}', [UsuarioController::class, 'alterar'])->name('usuario.alterar');
Route::get('/admin/usuarios/excluir/{_id}', [UsuarioController::class, 'excluir'])->name('usuario.excluir');
Route::get('/admin/usuarios/detalhes/{_id}', [UsuarioController::class, 'listar_um'])->name('usuario.detalhes');
Route::get('/admin/estacionamentos', [EstacionamentoController::class, 'listar'])->name('estacionamentos.listar');
Route::post('/admin/estacionamentos/inserir', [EstacionamentoController::class, 'inserir'])->name('estacionamento.inserir');
Route::get('/admin/estacionamentos/form/{_id?}', [EstacionamentoController::class, 'estacionamentos_form'])->name('estacionamento.form');
Route::put('/admin/estacionamentos/alterar/{_id}', [EstacionamentoController::class, 'alterar'])->name('estacionamento.alterar');
Route::get('/admin/estacionamentos/excluir/{_id}', [EstacionamentoController::class, 'excluir'])->name('estacionamento.excluir');
Route::get('/admin/estacionamentos/detalhes/{_id}', [EstacionamentoController::class, 'listar_um'])->name('estacionamento.detalhes');

