<?php

namespace App\Http\Controllers;

use App\Models\Estacionamento;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function show()
    {
        

        if (session('admin_authenticated')) {
            return view('estacionamentos.listar');
        } else {
            return redirect()->route('index');
        }
    }

    public function adminLogin(Request $request)
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
    $user = Admin::where('email', $email)->first();

    if ($user && $user->senha === $senha) {
        // Login bem-sucedido
        // Armazene o status de autenticação do admin na sessão
        $request->session()->put('admin_authenticated', true);
        
        return redirect()->route('estacionamentos.listar');
    } else {
        // Login falhou
        return redirect()->back()->with('login_failed', true);
    }
 }

 public function logout(){
    Auth::logout();
    return redirect()->route('index');
}

}
