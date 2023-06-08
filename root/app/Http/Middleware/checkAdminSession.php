<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdminSession
{
    public function handle($request, Closure $next)
    {
        // Verificar se a sessão de admin está presente
        if (!$request->session()->has('admin_authenticated')) {
            // Redirecionar o admin para a página inicial
            return redirect()->route('index');
        }

        return $next($request);
    }
}
