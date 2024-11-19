<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class LoginController extends Controller
{
    //
    /**
     * Exibe o formulário de login.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Processa o login.
     */
    public function login(Request $request)
    {
        // Validação dos dados do formulário
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Tenta autenticar o usuário
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Verifica o role do usuário e redireciona para o destino apropriado
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->route('dashboard'); // Redireciona para o Dashboard do Admin
            } else {
                return redirect()->route('tasks.index'); // Redireciona para a página de tarefas do Usuário
            }
        }

        // Retorna erro se as credenciais forem inválidas
        return back()->withErrors([
            'email' => 'As credenciais estão incorretas.',
        ])->onlyInput('email');
    }
    
    /**
     * Processa o logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        // Invalida e regenera o token da sessão
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Verifica se a rota de login existe
        if (Route::has('login')) {
            return redirect()->route('login')->with('message', 'Você foi deslogado com sucesso!');
        }

        // Caso contrário, redireciona para a página inicial
        return redirect('/')->with('message', 'Você foi deslogado com sucesso!');
    }
}
