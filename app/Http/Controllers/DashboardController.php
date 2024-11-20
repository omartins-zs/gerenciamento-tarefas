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
}
