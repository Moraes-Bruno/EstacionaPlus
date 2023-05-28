<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VagaController;
use App\Http\Controllers\AdminController;
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



Route::get('/', [VagaController::class, 'show']);
Route::get('/admin', [AdminController::class, 'show']);
Route::get('/admin/usuarios', [AdminController::class, 'exibir_usuarios']);
Route::get('/admin/usuarios/adicionar', [AdminController::class, 'adicionar_usuario']);
Route::get('/admin/usuarios/alterar', [AdminController::class, 'alterar_usuario']);
Route::get('/admin/usuarios/detalhes', [AdminController::class, 'detalhes_usuario']);
Route::get('/admin/estacionamentos', [AdminController::class, 'exibir_estacionamentos']);
Route::get('/admin/estacionamentos/adicionar', [AdminController::class, 'adicionar_estacionamentos']);
Route::get('/admin/estacionamentos/alterar', [AdminController::class, 'alterar_estacionamentos']);
Route::get('/admin/estacionamentos/detalhes', [AdminController::class, 'detalhes_estacionamentos']);
