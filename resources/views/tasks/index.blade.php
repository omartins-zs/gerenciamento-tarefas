@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-xl font-bold mb-4">Tarefas</h1>

    <a href="{{ route('tasks.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Nova Tarefa</a>

    <table class="w-full mt-4 border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border border-gray-300 px-4 py-2">Título</th>
                <th class="border border-gray-300 px-4 py-2">Status</th>
                <th class="border border-gray-300 px-4 py-2">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr class="hover:bg-gray-100">
                    <td class="border border-gray-300 px-4 py-2">{{ $task->title }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ ucfirst($task->status) }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <a href="{{ route('tasks.edit', $task) }}" class="text-blue-500">Editar</a>
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 ml-2">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
