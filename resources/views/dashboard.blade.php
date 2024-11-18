


<nav class="bg-gray-800 p-4">
    <div class="container mx-auto flex justify-between">
        <div>
            <a href="{{ route('dashboard') }}" class="text-gray-100 hover:text-gray-300">Dashboard</a>
        </div>
        <div>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="text-red-500 hover:underline">Logout</button>
            </form>
        </div>
    </div>
</nav>
