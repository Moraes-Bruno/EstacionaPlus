<?php

namespace App\Http\Controllers;

use App\Models\Estacionamento;
use App\Models\Usuário;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function usuarios_form($_id = false)
    {
        $estacionamentos = Estacionamento::all();
        if($_id){
            $dados = Usuário::findOrFail($_id);
            return view('usuarios_form', compact('dados'), compact('estacionamentos'));
        }
        else{
            return view('usuarios_form', compact('estacionamentos'));
        }
    }
    public function inserir(Request $request)
    {
        $dados = new Usuário($request->all());
        $dados->save();
        return redirect()->route('usuarios.listar');
    }

    public function listar()
    {
        $usuarios = Usuário::all();
        return view('exibir_usuarios', compact('usuarios'));
    }
    public function listar_um($id)
    {
        $dados = Usuário::findOrFail($id);
        return view('detalhes_usuario', compact('dados'));
    }
    public function alterar(Request $request, $id)
    {
        $dados = Usuário::findOrFail($id);
        $dados->nome = $request->nome;
        $dados->email = $request->email;
        $dados->senha = $request->senha;
        $dados->favoritos = $request->favoritos;
        $dados->save();
        return redirect()->route('usuarios.listar');
    }
    public function excluir($id)
    {
        $dados = Usuário::destroy($id);
        return redirect()->route('usuarios.listar');
    }

}
