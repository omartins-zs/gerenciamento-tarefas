<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cria 5 tarefas para cada usuário existente
        User::all()->each(function ($user) {
            Task::factory(5)->create([
                'user_id' => $user->id,
            ]);
        });
    }
}
