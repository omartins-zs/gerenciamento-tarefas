<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TaskPolicy
{
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Task $task): bool
    {
        // Verifica se o usuário é o dono da tarefa ou se o usuário é admin
        return $user->id === $task->user_id || $user->role === 'admin';
    }
}
