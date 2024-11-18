@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-xl font-bold">Tarefas</h1>
            <a href="{{ route('tasks.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Nova Tarefa</a>
        </div>
        <!-- Filtros -->
        <form method="GET" class="mb-4 flex items-center space-x-4">
            <div>
                <label class="block text-gray-700">Status</label>
                <select name="status" class="border border-gray-300 p-2 rounded">
                    <option value="">Todos</option>
                    <option value="pendente" @if (request('status') == 'pendente') selected @endif>Pendente</option>
                    <option value="em andamento" @if (request('status') == 'em andamento') selected @endif>Em Andamento</option>
                    <option value="concluída" @if (request('status') == 'concluída') selected @endif>Concluída</option>
                </select>
            </div>
            <div>
                <label class="block text-gray-700">Ordenar por</label>
                <select name="sort" class="border border-gray-300 p-2 rounded">
                    <option value="created_at" @if (request('sort') == 'created_at') selected @endif>Data de Criação</option>
                    <option value="title" @if (request('sort') == 'title') selected @endif>Título</option>
                    <option value="status" @if (request('sort') == 'status') selected @endif>Status</option>
                </select>
            </div>
            <div>
                <label class="block text-gray-700">Ordem</label>
                <select name="order" class="border border-gray-300 p-2 rounded">
                    <option value="asc" @if (request('order') == 'asc') selected @endif>Crescente</option>
                    <option value="desc" @if (request('order') == 'desc') selected @endif>Decrescente</option>
                </select>
            </div>
            <div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-6">Filtrar</button>
            </div>
        </form>

        <!-- Tabela de Tarefas -->
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 px-4 py-2">Título</th>
                    <th class="border border-gray-300 px-4 py-2">Status</th>
                    <th class="border border-gray-300 px-4 py-2">Criado em</th>
                    <th class="border border-gray-300 px-4 py-2">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tasks as $task)
                    <tr class="hover:bg-gray-100">
                        <td class="border border-gray-300 px-4 py-2">{{ $task->title }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ ucfirst($task->status) }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $task->created_at->format('d/m/Y H:i') }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <a href="{{ route('tasks.edit', $task) }}" class="text-blue-500">Editar</a>
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 ml-2">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center p-4">Nenhuma tarefa encontrada.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Paginação -->
        <div class="mt-4">
            {{ $tasks->links() }}
        </div>
    </div>
@endsection
