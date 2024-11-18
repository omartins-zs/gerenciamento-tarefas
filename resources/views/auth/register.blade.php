@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center min-h-screen bg-gray-900">
        <div class="w-full max-w-md bg-gray-800 rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-semibold text-center text-gray-100">Registrar</h1>
            <p class="text-sm text-center text-gray-400 mb-6">Crie sua conta</p>

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-500 text-gray-100 rounded">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-300 mb-1">Nome</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                        class="w-full px-4 py-2 bg-gray-700 text-gray-100 border border-gray-600 rounded focus:outline-none focus:ring focus:ring-gray-500">
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-300 mb-1">E-mail</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                        class="w-full px-4 py-2 bg-gray-700 text-gray-100 border border-gray-600 rounded focus:outline-none focus:ring focus:ring-gray-500">
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-300 mb-1">Senha</label>
                    <input type="password" name="password" id="password" required
                        class="w-full px-4 py-2 bg-gray-700 text-gray-100 border border-gray-600 rounded focus:outline-none focus:ring focus:ring-gray-500">
                </div>

                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-1">Confirmar
                        Senha</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                        class="w-full px-4 py-2 bg-gray-700 text-gray-100 border border-gray-600 rounded focus:outline-none focus:ring focus:ring-gray-500">
                </div>

                <button type="submit"
                    class="w-full bg-gray-600 text-gray-100 py-2 px-4 rounded hover:bg-gray-700 focus:outline-none focus:ring focus:ring-gray-500">
                    Registrar
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-sm text-gray-400">
                    Já tem uma conta?
                    <a href="{{ route('login') }}" class="text-gray-100 hover:underline">Entrar</a>
                </p>
            </div>
        </div>
    </div>
@endsection
