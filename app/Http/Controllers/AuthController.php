<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('');
        }

        return back()->withErrors([
            'email' => 'As credenciais estão incorretas.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Faz logout do usuário autenticado
        $request->session()->invalidate(); // Invalida a sessão atual
        $request->session()->regenerateToken(); // Gera um novo token CSRF

        return redirect('/login')->with('success', 'Você saiu com sucesso.'); // Redireciona para a página de login
    }
}
