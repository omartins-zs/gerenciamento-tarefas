@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center min-h-screen bg-gray-900">
        <div class="w-full max-w-md bg-gray-800 rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-semibold text-center text-gray-100">Login</h1>
            <p class="text-sm text-center text-gray-400 mb-6">Acesse sua conta</p>

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-500 text-gray-100 rounded">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-300 mb-1">E-mail</label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        value="{{ old('email') }}"
                        required
                        class="w-full px-4 py-2 bg-gray-700 text-gray-100 border border-gray-600 rounded focus:outline-none focus:ring focus:ring-gray-500"
                    >
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-300 mb-1">Senha</label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        required
                        class="w-full px-4 py-2 bg-gray-700 text-gray-100 border border-gray-600 rounded focus:outline-none focus:ring focus:ring-gray-500"
                    >
                </div>

                <div class="mb-6 text-right">
                    <a href="#" class="text-sm text-gray-400 hover:underline">Esqueceu sua senha?</a>
                </div>

                <button
                    type="submit"
                    class="w-full bg-gray-600 text-gray-100 py-2 px-4 rounded hover:bg-gray-700 focus:outline-none focus:ring focus:ring-gray-500"
                >
                    Entrar
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-sm text-gray-400">
                    Não tem uma conta?
                    <a href="#" class="text-gray-100 hover:underline">Registre-se</a>
                    {{-- <a href="{{ route('register') }}" class="text-gray-100 hover:underline">Registre-se</a> --}}
                </p>
            </div>
        </div>
    </div>
@endsection
