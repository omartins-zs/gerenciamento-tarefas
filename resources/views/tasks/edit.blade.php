@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-xl font-bold mb-4">Editar Tarefa</h1>

        <form action="{{ route('tasks.update', $task) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-gray-700">Título</label>
                <input type="text" name="title" value="{{ $task->title }}"
                    class="border border-gray-300 p-2 w-full rounded" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Descrição</label>
                <textarea name="description" class="border border-gray-300 p-2 w-full rounded">{{ $task->description }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Status</label>
                <select name="status" class="border border-gray-300 p-2 w-full rounded" required>
                    <option value="pendente" @if ($task->status == 'pendente') selected @endif>Pendente</option>
                    <option value="em andamento" @if ($task->status == 'em andamento') selected @endif>Em Andamento</option>
                    <option value="concluída" @if ($task->status == 'concluída') selected @endif>Concluída</option>
                </select>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Salvar</button>
        </form>
    </div>
@endsection
