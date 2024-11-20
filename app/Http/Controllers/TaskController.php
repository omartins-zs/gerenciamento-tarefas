<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TaskController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Log::info('Acessando o método index.');
        $user = Auth::user();

        $query = $user->role === 'admin' ? Task::query() : $user->tasks();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $sortField = $request->get('sort', 'created_at');
        $sortOrder = $request->get('order', 'desc');
        $query->orderBy($sortField, $sortOrder);

        $tasks = $query->paginate(10)->withQueryString();

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Log::info('Acessando o método create.');
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Log::info('Acessando o método store.');
        $request->validate([
            'title' => 'required|string|max:255|min:5',
            'description' => 'nullable|string',
            'status' => 'required|in:pendente,em andamento,concluída',
        ]);

        Auth::user()->tasks()->create($request->all());

        return redirect()->route('tasks.index')->with('success', 'Tarefa criada com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        Log::info('Acessando o método show para a tarefa ID: ' . $task->id);
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        Log::info('Acessando o método edit para a tarefa ID: ' . $task->id);

        // Autoriza o usuário com base na Policy (essa é a forma correta)
        $this->authorize('update', $task);  // Autoriza com a Policy 'update'

        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        Log::info('Acessando o método update para a tarefa ID: ' . $task->id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pendente,em andamento,concluída',
        ]);

        // Autoriza o usuário com base na Policy 'update'
        $this->authorize('update', $task);  // Autoriza com a Policy 'update'

        $task->update($request->all());

        return redirect()->route('tasks.index')->with('success', 'Tarefa atualizada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        Log::info('Acessando o método destroy para a tarefa ID: ' . $task->id);

        // Verifica se o usuário é admin ou se a tarefa pertence ao usuário
        if (Auth::user()->role !== 'admin' && Auth::user()->id !== $task->user_id) {
            // Caso não seja admin e a tarefa não pertença ao usuário, retorna erro 403
            Log::warning('Usuário não autorizado para excluir a tarefa ID: ' . $task->id);
            abort(403, 'Você não tem permissão para excluir esta tarefa.');
        }

        // Se passou pela verificação, pode excluir a tarefa
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Tarefa excluída com sucesso.');
    }
}
