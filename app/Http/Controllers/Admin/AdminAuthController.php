<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $user = Auth::user();
            
            // Verificar se é admin ou vet
            if ($user->role === 'admin' || $user->role === 'vet') {
                $request->session()->regenerate();
                return redirect()->intended('/admin/dashboard');
            }
            
            // Se for usuário comum, faz logout e retorna erro
            Auth::logout();
            return back()->with('error', 'Acesso negado. Apenas administradores e veterinários podem acessar esta área.');
        }

        return back()->withErrors([
            'email' => 'As credenciais fornecidas não correspondem aos nossos registros.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/admin/login');
    }
}
