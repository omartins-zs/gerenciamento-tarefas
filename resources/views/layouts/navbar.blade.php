<nav class="bg-gray-800 p-4">
    <div class="container mx-auto flex justify-between items-center">
        {{-- <a href="{{ url('/') }}" class="text-white text-lg font-bold">Tarefas Exata Tech</a> --}}
        <a href="{{ route('tasks.index') }}" class="text-white text-lg font-bold">Tarefas Exata Tech</a>
        <div class="flex items-center space-x-4">
            <!-- Link para Dashboard (apenas admin) -->
            @if (Auth::user()->role === 'admin')
                <a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-white">Dashboard</a>
            @endif

            <!-- Link para Tasks -->
            <a href="{{ route('tasks.index') }}" class="text-gray-300 hover:text-white">Tarefas</a>

            <!-- Logout -->
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="text-white bg-red-600 hover:bg-red-700 px-4 py-2 rounded">
                    Logout
                </button>
            </form>
        </div>
    </div>
</nav>
