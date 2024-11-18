@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Minhas Tarefas</h1>

        @foreach ($tasks as $task)
            <div class="p-4 mb-2 bg-gray-100 border rounded">
                <h2 class="text-lg font-bold">{{ $task->title }}</h2>
                <p class="text-sm text-gray-600">{{ $task->description }}</p>
                <p class="text-xs text-gray-500">{{ $task->status }}</p>
                <a href="{{ route('tasks.edit', $task) }}" class="text-blue-500">Editar</a>
                <form method="POST" action="{{ route('tasks.destroy', $task) }}" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500">Excluir</button>
                </form>
            </div>
        @endforeach
    </div>
@endsection
