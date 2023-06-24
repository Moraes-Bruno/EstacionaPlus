<?php

namespace App\Http\Controllers;

use App\Models\Estacionamento;
use App\Models\Usuário;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{

    public function showLogin()
    {
        return view('login');
    }

    public function usuarios_form($_id = false)
    {
        $estacionamentos = Estacionamento::all();
        if ($_id) {
            $dados = Usuário::findOrFail($_id);
            return view('usuarios_form', compact('dados'), compact('estacionamentos'));
        } else {
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
        $request->validate([
            'nome' => 'required',
            'email' => 'required|email',
            'senha' => 'required'
        ], [
            'nome.required' => 'o campo nome é obrigatório',
            'email.required' => 'O campo de email é obrigatório',
            'email.email' => 'Este campo deve possuir um email válido',
            'senha.required' => 'O campo senha é obrigatório'
        ]);

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
    public function alterar(Request $request, $id) //Função do painel do admin
    {
        $dados = Usuário::findOrFail($id);
        $dados->nome = $request->nome;
        $dados->email = $request->email;
        $dados->senha = $request->senha;
        $dados->favoritos = $request->favoritos;
        $dados->save();
        return redirect()->route('usuarios.listar');
    }



    public function alterarUser(Request $request) //Função para o usuario alterar as suas informações
    {
        $dados = Usuário::where('email', $request->input('email'))->first();
        $dados->nome = $request->nome;
        $dados->senha = $request->senha;
        $dados->save();
        return redirect()->route('userProfile');
    }

    public function excluir($id)
    {
        $dados = Usuário::destroy($id);
        return redirect()->route('usuarios.listar');
    }

    public function userLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'senha' => 'required'
        ], [
            'email.required' => 'O campo de email é obrigatório',
            'email.email' => 'Este campo deve possuir um email válido',
            'senha.required' => 'O campo senha é obrigatório'
        ]);

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

    public function logout(Request $request)
    {
        $request->session()->forget('user_id');
        $request->session()->flush();

        return redirect()->route('index');
    }

    public function showIndex2()
    {
        $estacionamentos = Estacionamento::all();
        return view('index2', ['estacionamentos' => $estacionamentos]);
    }

    public function showProfile()
    {
        return view('userInfo');
    }



    public function favoritar(Request $request)
    {
        $nome = $request->input('nome');

        $user_id = session('user_id');

        $usuario = Usuário::where('email', $user_id)->first();

        $favoritos = $usuario->favoritos ?? [];

        // Verifica se o nome já está presente no array de favoritos
        if (in_array($nome, $favoritos)) {
            return response()->json(['message' => 'Estacionamento já favoritado']);
        }

        $favoritos[] = $nome;

        // Atualiza o documento do usuário no MongoDB
        Usuário::where('email', $user_id)
            ->update(['favoritos' => $favoritos]);

        return response()->json(['message' => 'Estacionamento cadastrado com sucesso']);
    }

    public function removerFavorito(Request $request)
    {
        $nome = $request->input('nome');
        $user_id = session('user_id');

        $usuario = Usuário::where('email', $user_id)->first();
        $favoritos = $usuario->favoritos ?? [];

        // Constrói um novo array de favoritos, excluindo o elemento desejado
        $novosFavoritos = [];
        foreach ($favoritos as $favorito) {
            if ($favorito !== $nome) {
                $novosFavoritos[] = $favorito;
            }
        }

        // Atualiza o documento do usuário no MongoDB
        Usuário::where('email', $user_id)
            ->update(['favoritos' => $novosFavoritos]);

        return response()->json(['message' => 'Estacionamento removido dos favoritos']);
    }
}
