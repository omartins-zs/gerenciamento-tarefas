@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-xl font-bold mb-4">Nova Tarefa</h1>

    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700">Título</label>
            <input type="text" name="title" class="border border-gray-300 p-2 w-full rounded" required>
            @error('title')
                <div class="text-red-500">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Descrição</label>
            <textarea name="description" class="border border-gray-300 p-2 w-full rounded"></textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Status</label>
            <select name="status" class="border border-gray-300 p-2 w-full rounded" required>
                <option value="pendente">Pendente</option>
                <option value="em andamento">Em Andamento</option>
                <option value="concluída">Concluída</option>
            </select>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Salvar</button>
    </form>
</div>
@endsection
