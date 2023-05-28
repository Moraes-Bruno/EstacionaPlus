<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VagaController;
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

Route::view('/estacionamentoCad','estacionamentoCad');

use App\Http\Controllers\EstacionamentoController;

Route::post('/estacionamento/inserir', [EstacionamentoController::class, 'inserir'])->name('estacionamento.inserir');








