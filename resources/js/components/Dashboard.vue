<template>
  <div class="container mx-auto p-6 space-y-8">
    <!-- Cabeçalho -->
    <div class="flex flex-col md:flex-row md:justify-between items-center bg-blue-100 p-4 rounded shadow">
      <div>
        <h1 class="text-2xl font-bold text-blue-600">Dashboard</h1>
        <p class="text-sm text-gray-600">Bem-vindo ao painel principal</p>
      </div>
      <div class="mt-4 md:mt-0 text-right">
        <p class="text-sm">Olá, <strong>{{ user.name }}</strong></p>
        <p class="text-sm text-gray-600">E-mail: {{ user.email }}</p>
        <p class="text-sm text-gray-600">Nível de Acesso: {{ user.role }}</p>
      </div>
    </div>

    <!-- Informações Gerais -->
    <div v-if="user.role === 'admin'" class="bg-white p-6 rounded shadow-md">
      <h3 class="text-lg font-semibold">Informações Gerais</h3>
      <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-4">
        <div class="bg-blue-50 p-4 rounded text-center shadow hover:bg-blue-100">
          <p class="text-blue-600 text-2xl font-bold">{{ stats.totalTasks }}</p>
          <p class="text-gray-600">Total de Tarefas</p>
        </div>
        <div class="bg-blue-50 p-4 rounded text-center shadow">
          <p class="text-green-600 text-2xl font-bold">{{ stats.adminTasks }}</p>
          <p class="text-gray-600">Tarefas do Admin</p>
        </div>
        <div class="bg-blue-50 p-4 rounded text-center shadow">
          <p class="text-purple-600 text-2xl font-bold">{{ stats.totalUsers }}</p>
          <p class="text-gray-600">Total de Usuários</p>
        </div>
      </div>
    </div>

    <!-- Gerenciar Usuários -->
    <div v-if="user.role === 'admin'" class="bg-white p-6 rounded shadow-md">
      <h2 class="text-xl font-semibold mb-4">Gerenciar Usuários</h2>
      <div class="overflow-x-auto">
        <table class="table-auto w-full text-sm border-collapse border border-gray-300">
          <thead>
            <tr class="bg-gray-100 text-left">
              <th class="px-4 py-2 border">Nome</th>
              <th class="px-4 py-2 border">E-mail</th>
              <th class="px-4 py-2 border">Nível de Acesso</th>
              <th class="px-4 py-2 border">Ação</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="userItem in users" :key="userItem.id">
              <td class="px-4 py-2 border">{{ userItem.name }}</td>
              <td class="px-4 py-2 border">{{ userItem.email }}</td>
              <td class="px-4 py-2 border">{{ userItem.role }}</td>
              <td class="px-4 py-2 border">
                <form @submit.prevent="updateRole(userItem.id)">
                  <select v-model="userItem.role" class="p-2 border rounded">
                    <option value="user">Usuário</option>
                    <option value="admin">Admin</option>
                  </select>
                  <button type="submit" class="ml-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                    Alterar
                  </button>
                </form>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Minhas Tarefas -->
    <div class="bg-white p-6 rounded shadow-md">
      <h2 class="text-xl font-semibold mb-4">Minhas Tarefas</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <div v-for="task in tasks" :key="task.id" class="bg-gray-50 p-4 rounded shadow">
          <h3 class="font-semibold text-lg">{{ task.title }}</h3>
          <p class="text-gray-600">Status: {{ task.status }}</p>
          <div class="flex justify-between mt-4">
            <a :href="'/tasks/' + task.id + '/edit'" class="text-blue-500 hover:underline">Editar</a>
            <button @click="deleteTask(task.id)" class="text-red-500 hover:underline">Excluir</button>
          </div>
        </div>
      </div>
      <div class="mt-4">
        <!-- Paginação será implementada posteriormente -->
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    user: Object,
    stats: Object,
    users: Array,
    tasks: Array,
  },
  methods: {
    updateRole(userId) {
      // Implementar a lógica para enviar a atualização do papel do usuário ao backend.
      console.log("Atualizando papel do usuário:", userId);
    },
    deleteTask(taskId) {
      // Implementar a lógica para excluir a tarefa no backend.
      console.log("Excluindo tarefa:", taskId);
    },
  },
};
</script>

<style scoped>
/* Adicione estilos específicos do componente, se necessário */
</style>
