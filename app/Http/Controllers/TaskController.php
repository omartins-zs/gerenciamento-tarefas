<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        // Base da consulta
        $query = $user->role === 'admin' ? Task::query() : $user->tasks();

        // Aplicar filtros
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Aplicar ordenação
        $sortField = $request->get('sort', 'created_at'); // Padrão: ordenar por data de criação
        $sortOrder = $request->get('order', 'desc'); // Padrão: ordem decrescente
        $query->orderBy($sortField, $sortOrder);

        // Paginação
        $tasks = $query->paginate(10)->withQueryString();

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pendente,em andamento,concluída',
        ]);

        auth()->user()->tasks()->create($request->all());

        return redirect()->route('tasks.index')->with('success', 'Tarefa criada com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        // Garantir que o usuário autenticado é o dono da tarefa ou é admin
        if (auth()->user()->cannot('update', $task)) {
            abort(403);
        }

        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pendente,em andamento,concluída',
        ]);

        // Garantir que o usuário autenticado é o dono da tarefa ou é admin
        if (auth()->user()->cannot('update', $task)) {
            abort(403);
        }

        $task->update($request->all());

        return redirect()->route('tasks.index')->with('success', 'Tarefa atualizada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        // Garantir que o usuário autenticado é o dono da tarefa ou é admin
        if (auth()->user()->cannot('delete', $task)) {
            abort(403);
        }

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Tarefa excluída com sucesso.');
    }
}
