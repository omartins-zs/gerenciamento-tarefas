<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Task;
use App\Policies\TaskPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Task::class => TaskPolicy::class, // Mapeia Task para TaskPolicy
    ];

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // O Laravel já registra as policies automaticamente a partir do Laravel 10,
        // então não é necessário chamar registerPolicies() manualmente.
    }
}
