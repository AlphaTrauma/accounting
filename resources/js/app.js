import './bootstrap';

import { createApp } from 'vue/dist/vue.esm-bundler.js';
//import store from './store';
import MenuItems from './Components/Dashboard/MenuItems.vue';
import TextEditor from './Components/Dashboard/TextEditor.vue';

const app = createApp();

// Регистрируем глобальные компоненты
app.component('menu-items', MenuItems);
app.component('text-editor', TextEditor);

//app.use(store);

app.mount('#app');
