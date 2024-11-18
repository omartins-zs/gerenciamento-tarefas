<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
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

        if (Auth::user()->cannot('update', $task)) {
            Log::warning('Usuário não autorizado para editar a tarefa ID: ' . $task->id);
            abort(403, 'Você não tem permissão para editar esta tarefa.');
        }

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

        if (Auth::user()->cannot('update', $task)) {
            Log::warning('Usuário não autorizado para atualizar a tarefa ID: ' . $task->id);
            abort(403, 'Você não tem permissão para atualizar esta tarefa.');
        }

        $task->update($request->all());

        return redirect()->route('tasks.index')->with('success', 'Tarefa atualizada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        Log::info('Acessando o método destroy para a tarefa ID: ' . $task->id);

        if (Auth::user()->cannot('delete', $task)) {
            Log::warning('Usuário não autorizado para excluir a tarefa ID: ' . $task->id);
            abort(403, 'Você não tem permissão para excluir esta tarefa.');
        }

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Tarefa excluída com sucesso.');
    }
}
