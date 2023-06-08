<?php

namespace App\Http\Middleware;

use Closure;

class CheckUserSession
{
    public function handle($request, Closure $next)
    {
        // Verificar se a sessão de usuário está presente
        if (!$request->session()->has('user_id')) {
            // Redirecionar o usuário para a página inicial
            return redirect()->route('index');
        }

        return $next($request);
    }
}

