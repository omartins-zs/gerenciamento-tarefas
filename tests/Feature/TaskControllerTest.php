<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase; // Limpa o banco de dados após cada teste

    /**
     * A basic feature test example.
     */
    // public function test_example(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }

    public function test_authenticated_user_can_store_task()
    {
        // Simula um usuário autenticado
        $user = User::factory()->create();

        // Dados que serão enviados para a função store
        $taskData = [
            'title' => 'Minha Tarefa',
            'description' => 'Descrição da tarefa',
            'status' => 'pendente',
        ];

        // Envia uma requisição POST como o usuário autenticado
        $response = $this->actingAs($user)->post(route('tasks.store'), $taskData);

        // Verifica se o redirecionamento ocorreu corretamente
        $response->assertRedirect(route('tasks.index'));

        // Verifica se a tarefa foi criada no banco de dados
        $this->assertDatabaseHas('tasks', [
            'title' => 'Minha Tarefa',
            'description' => 'Descrição da tarefa',
            'status' => 'pendente',
            'user_id' => $user->id, // A tarefa pertence ao usuário autenticado
        ]);
    }

    public function test_store_requires_validation()
    {
        // Simula um usuário autenticado
        $user = User::factory()->create();

        // Envia uma requisição POST com dados inválidos
        $response = $this->actingAs($user)->post(route('tasks.store'), []);

        // Verifica se o status HTTP retornado é 302 (redirecionamento devido à validação)
        $response->assertStatus(302);

        // Verifica se erros de validação foram retornados
        $response->assertSessionHasErrors(['title', 'status']);
    }

}
