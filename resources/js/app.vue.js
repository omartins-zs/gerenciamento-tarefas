import { createApp } from 'vue';
import Dashboard from './components/Dashboard.vue';

const appData = JSON.parse(document.getElementById('app-data').textContent);

createApp(Dashboard, appData).mount('#app');
