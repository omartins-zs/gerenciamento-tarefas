<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function __construct()
    {
        Log::info('DashboardController carregado.');
    }

    /**
     * Exibe o dashboard com as tarefas do usuário autenticado.
     */
    public function index()
    {
        Log::info('Método index do DashboardController chamado.');

        $user = Auth::user();

        if ($user->role === 'admin') {
            $totalTasks = Task::count(); // Quantidade total de tarefas
            $tasks = Task::where('user_id', $user->id)->paginate(10); // Apenas tarefas do admin
            $totalUsers = User::count(); // Total de usuários
            $users = User::all(); // Lista todos os usuários
            Log::info('Tarefas e usuários recuperados com sucesso.');
        } else {
            $tasks = $user->tasks()->paginate(10);
            $totalTasks = $tasks->total();
            $totalUsers = null;
            $users = null;
            Log::info('Tarefas recuperadas com sucesso.');
        }

        return view('dashboard', compact('tasks', 'users', 'totalTasks', 'totalUsers'));
    }
    /**
     * Atualiza o nível de acesso (role) de um usuário.
     */
    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:user,admin', // Permitir apenas 'user' ou 'admin'
        ]);

        $currentUser = Auth::user();

        // Garantir que apenas o admin pode alterar o nível de acesso
        if ($currentUser->role !== 'admin') {
            return back()->withErrors(['error' => 'Você não tem permissão para alterar o nível de acesso.']);
        }

        // Atualizar o nível de acesso
        $user->role = $request->role;
        $user->save();

        return back()->with('success', 'Nível de acesso do usuário atualizado com sucesso.');
    }
}
