<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
   public function show()
   {
       return view('admin');
   }
   public function exibir_usuarios()
   {
       return view('exibir_usuarios');
   }
   public function adicionar_usuario()
   {
       return view('adicionar_usuario');
   }
   public function alterar_usuario()
   {
       return view('alterar_usuario');
   }
   public function detalhes_usuario()
   {
       return view('detalhes_usuario');
   }
   public function exibir_estacionamentos()
   {
       return view('exibir_estacionamentos');
   }
   public function adicionar_estacionamentos()
   {
       return view('adicionar_estacionamentos');
   }
   public function alterar_estacionamentos()
   {
       return view('alterar_estacionamentos');
   }
   public function detalhes_estacionamentos()
   {
       return view('detalhes_estacionamentos');
   }
}
