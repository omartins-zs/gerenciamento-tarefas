<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Task::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(), // Cria ou associa a um usuário existente
            'title' => $this->faker->sentence(3), // Exemplo: "Finalizar o projeto"
            'description' => $this->faker->paragraph, // Exemplo: "Descrição detalhada da tarefa"
            'status' => $this->faker->randomElement(['pendente', 'em andamento', 'concluída']),
        ];
    }
}
