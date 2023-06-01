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

    //metodo usado pelo adminin para cadastar
    public function inserir(Request $request)
    {
        $dados = new Usuário($request->all());
        $dados->save();
        return redirect()->route('usuarios.listar');
    }

    //Metodo usado pelo usuario para se cadastrar
    public function inserirUser(Request $request)
    {
        // Verificar se o email já está cadastrado
        $email = $request->input('email');
        $usuarioExistente = Usuário::where('email', $email)->first();
    
        if ($usuarioExistente) {
            // Email já cadastrado, redirecionar para a mesma página e exibir alerta
            return redirect()->back()->with('email_cadastrado', true);
        }
    
        // Criar novo usuário
        $dados = new Usuário($request->all());
        $dados->save();
    
        return redirect()->route('index');
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

    public function userLogin(Request $request)
    {
        $email = $request->input('email');
        $senha = $request->input('senha');
    
        // Perform the login logic here
        // You can use the $email and $senha variables to authenticate the user
    
        // Example login logic:
        $user = Usuário::where('email', $email)->first();
    
        if ($user && $user->senha === $senha) {
            
            // Login successful
            // Store the user's authentication status in the session
            $request->session()->put('user_id', $user->email);
            
            return redirect()->route('index2');
        } else {
            // Login failed
            return redirect()->back()->with('login_failed', true);
        }
    }
    




}
