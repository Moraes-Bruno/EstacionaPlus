<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VagaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EstacionamentoController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Session;

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



Route::get('/', [EstacionamentoController::class, 'show'])->name('index');
Route::get('/home', [EstacionamentoController::class, 'showhome'])->name('home');

Route::group(['middleware' => 'checkAdminSession'], function () {//Session de Admin

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
});

Route::group(['middleware' => 'checkUserSession'], function () {//Session de Usuario
    Route::get('/logout', [UsuarioController::class, 'logout'])->name('logout');//Faz o logout do usuario
    Route::get('/userInfo',  [UsuarioController::class, 'showProfile'])->name('userProfile');
    Route::post('/userInfo/alterar', [UsuarioController::class, 'alterarUser'])->name('usuario.alterarUser');
    Route::post('/index2',  [UsuarioController::class, 'favoritar'])->name('usuario.favoritar');
    Route::post('/userInfo',  [UsuarioController::class, 'removerFavorito'])->name('usuario.removerFavorito');

});

//Processo de Cadastro/login de Usuario
Route::view('/cadUsuario','cadUsuario');//link para a pagina de cadastro
Route::post('/cadUsuario', [UsuarioController::class, 'inserirUser'])->name('usuario.inserirUser');//cadastra Usuario
route::view('/login','login')->name('login');//link para a pagina de login
Route::post('/login', [UsuarioController::class, 'userLogin'])->name('usuario.userLogin');//Login de Usuario

//Processo de Login do Admin
Route::view('/adminLogin','adminLogin')->name('adminLogin');
Route::post('/adminLogin',[AdminController::class, 'adminLogin'])->name('admin.adminLogin');
Route::get('/admin',[AdminController::class, 'show'])->name('admin');


