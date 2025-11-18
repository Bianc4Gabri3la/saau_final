<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }

        $user = Auth::user();
        
        if ($user->role !== 'admin' && $user->role !== 'vet') {
            Auth::logout();
            return redirect()->route('admin.login')
                ->with('error', 'Acesso negado. Apenas administradores e veterinários podem acessar esta área.');
        }

        return $next($request);
    }
}
