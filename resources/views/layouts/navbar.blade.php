<nav class="bg-blue-600 text-white shadow-md">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="relative flex items-center justify-between h-16">
            <!-- Nome do Sistema (à esquerda) -->
            <div class="flex-shrink-0 text-xl font-semibold">
                Tarefas Exata Tech
            </div>
            <!-- Botão de Logout (à direita) -->
            <div class="ml-auto">
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-white bg-red-600 hover:bg-red-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Logout</button>
                </form>
            </div>
        </div>
    </div>
</nav>
