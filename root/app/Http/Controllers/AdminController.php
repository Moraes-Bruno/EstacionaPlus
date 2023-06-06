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
        

        if (session('user_id')) {
            return view('admin');
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
        
        // Login successful
        // Store the user's authentication status in the session
        $request->session()->put('user_id', $user->email);
        
        return redirect()->route('admin');
    } else {
        // Login failed
        return redirect()->back()->with('login_failed', true);
    }
 }

 public function logout(){
    Auth::logout();
    return redirect()->route('index');
}

}
