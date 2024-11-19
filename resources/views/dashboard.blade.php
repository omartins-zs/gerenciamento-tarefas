@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6 space-y-8">
        <!-- Cabeçalho -->
        <div class="flex flex-col md:flex-row md:justify-between items-center bg-blue-100 p-4 rounded shadow">
            <div>
                <h1 class="text-2xl font-bold text-blue-600">Dashboard</h1>
                <p class="text-sm text-gray-600">Bem-vindo ao painel principal</p>
            </div>
            <div class="mt-4 md:mt-0 text-right">
                <p class="text-sm">Olá, <strong>{{ Auth::user()->name }}</strong></p>
                <p class="text-sm text-gray-600">E-mail: {{ Auth::user()->email }}</p>
                <p class="text-sm text-gray-600">Nivel de Acesso: {{ Auth::user()->role }}</p>
            </div>
        </div>

        <!-- Informações Gerais -->
        @if (Auth::user()->role === 'admin')
            <div class="bg-white p-6 rounded shadow-md">
                <h3 class="text-lg font-semibold">Informações Gerais</h3>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-4">
                    <div class="bg-blue-50 p-4 rounded text-center shadow">
                        <p class="text-blue-600 text-2xl font-bold">{{ $totalTasks }}</p>
                        <p class="text-gray-600">Total de Tarefas</p>
                    </div>
                    <div class="bg-blue-50 p-4 rounded text-center shadow">
                        <p class="text-green-600 text-2xl font-bold">{{ $tasks->total() }}</p>
                        <p class="text-gray-600">Tarefas do Admin</p>
                    </div>
                    <div class="bg-blue-50 p-4 rounded text-center shadow">
                        <p class="text-purple-600 text-2xl font-bold">{{ $totalUsers }}</p>
                        <p class="text-gray-600">Total de Usuários</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Gerenciar Usuários -->
        @if (Auth::user()->role === 'admin')
            <div class="bg-white p-6 rounded shadow-md">
                <h2 class="text-xl font-semibold mb-4">Gerenciar Usuários</h2>
                <div class="overflow-x-auto">
                    <table class="table-auto w-full text-sm border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100 text-left">
                                <th class="px-4 py-2 border">Nome</th>
                                <th class="px-4 py-2 border">E-mail</th>
                                <th class="px-4 py-2 border">Nível de Acesso</th>
                                <th class="px-4 py-2 border">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td class="px-4 py-2 border">{{ $user->name }}</td>
                                    <td class="px-4 py-2 border">{{ $user->email }}</td>
                                    <td class="px-4 py-2 border">{{ $user->role }}</td>
                                    <td class="px-4 py-2 border">
                                        <form action="{{ route('dashboard.updateRole', $user->id) }}" method="POST"
                                            class="flex items-center">
                                            @csrf
                                            @method('PUT')
                                            <select name="role" class="p-2 border rounded">
                                                <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>
                                                    Usuário</option>
                                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>
                                                    Admin</option>
                                            </select>
                                            <button type="submit"
                                                class="ml-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                                Alterar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        <!-- Minhas Tarefas -->
        <div class="bg-white p-6 rounded shadow-md">
            <h2 class="text-xl font-semibold mb-4">Minhas Tarefas</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($tasks as $task)
                    <div class="bg-gray-50 p-4 rounded shadow">
                        <h3 class="font-semibold text-lg">{{ $task->title }}</h3>
                        <p class="text-gray-600">Status: {{ $task->status }}</p>
                        <div class="flex justify-between mt-4">
                            <a href="{{ route('tasks.edit', $task->id) }}" class="text-blue-500 hover:underline">Editar</a>
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                                onsubmit="return confirm('Tem certeza que deseja excluir?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Excluir</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-4">
                {{ $tasks->links() }} <!-- Paginação -->
            </div>
        </div>
    </div>
@endsection
