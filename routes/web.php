<?php
use Illuminate\Support\Facades\Log;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Rotas de autenticação (login e registro)
Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
});

// Logout (POST)
Route::post('logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

// Rotas autenticadas
Route::middleware('auth')->group(function () {
    // Dashboard
    Log::info('Middleware de autenticação ativado.');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::put('/dashboard/update-role/{user}', [DashboardController::class, 'updateRole'])->name('dashboard.updateRole');

    Log::info('Rota de dashboard registrada.');

    // CRUD de tarefas
    Route::resource('tasks', TaskController::class);
});
